<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Utils;

use AppBundle\Search\TermSplitter;

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
class TermSplitterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getTerms
     */
    public function testSplitIntoTerms($string, $terms)
    {
        $termSplitter = new TermSplitter();
        $termSplitter->setMinTermLength(3);
        $result = $termSplitter->splitIntoTerms($string);

        $this->assertEquals($terms, $result);
    }

    public function getTerms()
    {
        return array(
            array('', array()),
            array('a b c d e f g', array()),
            array('Lorem Ipsum', array('lorem', 'ipsum')),
            array('<<<<Lo----====rem Ip@#</script>sum', array('lorem', 'ipscriptsum')),
        );
    }
}
