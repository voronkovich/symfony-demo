<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Search;

/**
 * Splits a search query into terms.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class TermSplitter
{
    /**
     * Minimal searching term length.
     *
     * @var int
     */
    private $minTermLength = 2;

    /**
     * Splits a query string into terms.
     *
     * @param string $str
     *
     * @return array Terms
     */
    public function splitIntoTerms($str)
    {
        $terms = array_unique(explode(' ', strtolower($this->sanitize($str))));

        return $this->removeShortTerms($terms);
    }

    /**
     * Gets a minimal searching term length.
     *
     * @return int
     */
    public function getMinTermLength()
    {
        return $this->minTermLength;
    }

    /**
     * Sets a minimal searching term length.
     *
     * @param int $minTermLength
     *
     * @return TermSplitter
     */
    public function setMinTermLength($minTermLength)
    {
        $minTermLength = (int) $minTermLength;

        if ($minTermLength < 1) {
            throw new \OutOfRangeException('Min term length must be more than 1');
        }

        $this->minTermLength = $minTermLength;

        return $this;
    }

    /**
     * Removes multiple spaces and all symbols but alphabetic chars.
     *
     * @param string $str
     *
     * @return string Sanitized string
     */
    private function sanitize($str)
    {
        return preg_replace('/[^[:alnum:] ]/', '', trim(preg_replace('/[[:space:]]+/', ' ', $str)));
    }

    /**
     * Removes short terms.
     *
     * @param array $terms
     *
     * @param array Filtered terms
     */
    private function removeShortTerms(array $terms)
    {
        $minTermLength = $this->minTermLength;

        return array_filter($terms, function($term) use ($minTermLength) {
            return strlen($term) >= $minTermLength;
        });
    }
}
