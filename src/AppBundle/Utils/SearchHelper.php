<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Utils;

/**
 * This class contains helper methods for searching posts.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class SearchHelper
{
    /**
     * Emphasize terms in string.
     *
     * @param string $text
     * @param array $terms
     * @param string $tag
     *
     * @return string with emphasized terms
     */
    public static function emphasizeTerms($text, array $terms, $tag = 'em')
    {
        $patterns = array_map(function($term) {
            return sprintf('/%s/', $term);
        }, $terms);

        return preg_replace($patterns, "<$tag>\${0}</$tag>", $text);
    }

    /**
     * Split string into terms.
     *
     * @param string $text
     * @param int $minTermLength
     *
     * @return array with terms
     */
    public static function splitIntoTerms($text, $minTermLength = 2)
    {
        $terms = array_unique(explode(' ', preg_replace('/[^[:alpha:][:space:]]/', '', trim($text))));

        return array_filter($terms, function($term) use ($minTermLength) {
            return strlen($term) >= $minTermLength;
        });
    }
}
