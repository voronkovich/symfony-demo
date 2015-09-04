<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Search;

use AppBundle\Search\TermEmphasizer;

/**
 * Unit test for the application utils.
 * See http://symfony.com/doc/current/book/testing.html#unit-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ phpunit -c app
 *
 */
class TermEmphasizerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getEmphasizedStrings
     */
    public function testEmphasizeTerms($string, $emphasizedString)
    {
        $termEmphasizer = new TermEmphasizer();
        $termEmphasizer->setTemplate('<em>%s</em>');
        $termEmphasizer->enableCaseless();

        $result = $termEmphasizer->emphasizeTerms($string, array('loRem', 'iPsum', 'SymFony'));

        $this->assertEquals($emphasizedString, $result);
    }

    public function getEmphasizedStrings()
    {
        return array(
            array('', ''),
            array('noterms', 'noterms'),
            array('jjloremddd eeipsum', 'jj<em>lorem</em>ddd ee<em>ipsum</em>'),
            array('jdddsymfonyeeum', 'jddd<em>symfony</em>eeum'),
        );
    }
}
