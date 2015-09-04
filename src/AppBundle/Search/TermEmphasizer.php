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
 * Emphasizes terms in a search string.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class TermEmphasizer
{
    /**
     * Template for emphasizing terms.
     *
     * @var string
     */
    private $template = '<em>%s</em>';

    /**
     * Ignore a letter case.
     *
     * @var bool
     */
    private $caseless = true;

    /**
     * Emphasizes terms in a string.
     *
     * @param string $str
     * @param array $terms
     *
     * @return string A string with emphasized terms
     */
    public function emphasizeTerms($str, array $terms)
    {
        $tmpl = $this->caseless ? '/%s/i' : '/%s/';

        $patterns = array_map(function($term) use ($tmpl) {
            return sprintf($tmpl, $term);
        }, $terms);

        return preg_replace($patterns, sprintf($this->template, '${0}'), $str);
    }

    /**
     * Sets a template for emphasizing terms.
     *
     * @param string $template
     *
     * @return TermEmphasizer
     */
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Gets a template for emphasizing terms.
     *
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Enables the 'caseless' mode.
     *
     * @return TermEmphasizer
     */
    public function enableCaseless()
    {
        $this->caseless = true;

        return $this;
    }

    /**
     * Disables the 'caseless' mode.
     *
     * @return TermEmphasizer
     */
    public function disableCaseless()
    {
        $this->caseless = false;

        return $this;
    }

    /**
     * Checks whether the 'caseless' mode enabled.
     *
     * @return bool
     */
    public function isCaseless()
    {
        return $this->caseless;
    }
}
