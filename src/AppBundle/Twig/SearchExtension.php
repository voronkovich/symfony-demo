<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Twig;

/**
 * This Twig extension adds a new 'emphasize_terms' filter to easily emphasize searched
 * terms in strings.
 * See http://symfony.com/doc/current/cookbook/templating/twig_extension.html
 *
 * In addition to creating the Twig extension class, before using it you must also
 * register it as a service. See app/config/services.yml file for details.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class SearchExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('emphasize_terms', '\AppBundle\Utils\SearchHelper::emphasizeTerms'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app.search';
    }
}
