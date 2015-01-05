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
 * TitleTest
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
class TitleTest extends AbstractHelperTest
{

    /**
    * testString
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function testAll()
    {
        $helper = $this->helper;
        $this->assertSame(
            $helper('Foo'),
            $this->helper
        );

        $helper->setIncludeSiteName(true);
        $helper->setIncludeMeta(true);

        $this->assertSame(
            $this->helper->setSiteTitle('Site'),
            $this->helper
        );

        $this->assertSame(
            $this->helper->setTitleSeparator(' * '),
            $this->helper
        );

        $this->assertEquals(
            "    <title>Foo * Site</title>\n",
            (string) $this->helper
        );

    }



    /**
    * getMockMeta
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function getMockMeta()
    {
        $escaper = $this->getMockAuraEscaper();
        return $this->getMockBuilder('\Aura\Html\Helper\Metas')
            ->setConstructorArgs([$escaper])
            ->getMock();
    }

    /**
    * getMockTitle
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function getMockTitle()
    {
        $escaper = $this->getMockAuraEscaper();
        return $this->getMockBuilder('\Aura\Html\Helper\Title')
            ->setConstructorArgs([$escaper])
            ->getMock();
    }

    /**
    * newHelper
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function newHelper()
    {
        $eFac = new \Aura\Html\EscaperFactory();
        $esc = $eFac->newInstance();
        $metas = $this->getMockMeta();
        $title = new \Aura\Html\Helper\Title($esc);

        return new Title(
            $title,
            $metas,
            $esc
        );
    }

    /**
    * getMockAuraEscaper
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function getMockAuraEscaper()
    {
        $escaper = parent::getMockAuraEscaper();
        $escaper->expects($this->any())
            ->method('html')
            ->will(
                $this->returnCallback(
                    function () {
                        return func_get_args()[0];
                    }
                )
            );

        return $escaper;
    }

}

