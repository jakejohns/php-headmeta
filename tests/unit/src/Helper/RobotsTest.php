<?php
/**
* HeadMeta
*
* PHP version 5
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program.  If not, see <http://www.gnu.org/licenses/>.
*
* @category  HeadMEta
* @package   Tests
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2014 Jake Johns
* @license   http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
* @link      http://jakejohns.net
 */

namespace Jnj\HeadMeta\Helper;

/**
 * RobotsTest
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 * @see      \PHPUnit_Framework_TestCase
 */
class RobotsTest extends AbstractHelperTest
{

    /**
    * testArray
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function testArray()
    {
        $val = 'index, nofollow';

        $expected = [
            'name'    => 'robots',
            'content' => $val,
        ];

        $this->helper->setValue($val);
        $this->assertEquals(
            $expected,
            $this->helper->toArray()
        );
    }

    /**
    * testExtra
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function testExtra()
    {
        $val = 'index, follow, nocache';

        $this->helper->setValue($val);

        $expected = [
            'name'    => 'robots',
            'content' => $val
        ];

        $this->assertEquals(
            $expected,
            $this->helper->toArray()
        );
    }

    /**
    * testHelperMethods
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function testHelperMethods()
    {
        $helper = $this->helper;

        $helper->noIndex();
        $this->assertEquals(
            'noindex, follow',
            $this->helper->toArray()['content']
        );

        $helper->index();
        $this->assertEquals(
            'index, follow',
            $this->helper->toArray()['content']
        );

        $helper->noFollow();
        $this->assertEquals(
            'index, nofollow',
            $this->helper->toArray()['content']
        );

        $helper->follow();
        $this->assertEquals(
            'index, follow',
            $this->helper->toArray()['content']
        );


    }


}

