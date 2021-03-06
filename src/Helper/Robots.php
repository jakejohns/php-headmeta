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
* @category  HeadMeta
* @package   HeadMeta
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2014 Jake Johns
* @license   http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
* @link      http://jakejohns.net
 */


namespace Jnj\HeadMeta\Helper;

/**
 * Robots
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
class Robots
{
    use Traits\MetaPropertyTrait;

    protected $index = 'index';

    protected $follow = 'follow';

    protected $extra = [];

    /**
    * initDefault
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function initDefault()
    {
        return 'index, follow';
    }

    /**
    * setValue
    *
    * @param mixed $string DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function setValue($string)
    {
        if (! is_array($string)) {
            $string = explode(",", $string);
        }

        $extras = ['noodp', 'noarchive', 'nosnippet',
            'noimageindex', 'noydir', 'nocache'];

        $indexes = ['index', 'noindex'];

        $follows = ['follow', 'nofollow'];

        foreach ($string as $key => $value) {
            $key = trim(strtolower($key));
            $value = trim(strtolower($value));

            if ($key == 'index' || in_array($value, $indexes)) {
                $this->index = $value;
            } elseif ($key == 'follow' || in_array($value, $follows)) {
                $this->follow = $value;
            } elseif (in_array($value, $extras)) {
                $this->extra[] = $value;
            }
        }
        return $this;
    }

    /**
    * getValue
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function getValue()
    {
        return implode(
            ', ',
            array_filter(
                array_merge(
                    [$this->index, $this->follow],
                    $this->extra
                )
            )
        );
    }

    /**
    * index
    *
    * @return Robots
    *
    * @access public
    */
    public function index()
    {
        $this->index = 'index';
        return $this;
    }

    /**
    * noindex
    *
    * @return Robots
    *
    * @access public
    */
    public function noIndex()
    {
        $this->index = 'noindex';
        return $this;
    }

    /**
    * follow
    *
    * @return Robots
    *
    * @access public
    */
    public function follow()
    {
        $this->follow = 'follow';
        return $this;
    }

    /**
    * nofollow
    *
    * @return Robots
    *
    * @access public
    */
    public function noFollow()
    {
        $this->follow = 'nofollow';
        return $this;
    }


    /**
    * toArray
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function toArray()
    {
        return [
            'name'    => 'robots',
            'content' => $this->getValue(),
        ];
    }

}



