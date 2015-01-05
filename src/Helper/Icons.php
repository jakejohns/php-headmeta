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

use Aura\Html\Helper\Links as AuraLinksHelper;

/**
 * Icons
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
class Icons
{
    use Traits\ProcessorTrait;

    protected $links;

    protected $touchSizes = [144, 114, 72, 57];

    protected $touchPattern = '/assets/ico/apple-touch-icon-%sx%1$s.png';

    protected $favicon = '/assets/ico/favicon.ico';

    /**
    * __construct
    *
    * @param AuraLinksHelper $links DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function __construct(AuraLinksHelper $links)
    {
        $this->links = $links;
    }

    /**
    * __invoke
    *
    * @return mixed
    *
    * @access public
    */
    public function __invoke()
    {
        return $this;
    }

    /**
    * setTouchSizes
    *
    * @param array $sizes icon sizes
    *
    * @return Icons
    *
    * @access public
    */
    public function setTouchSizes(array $sizes)
    {
        $this->touchSizes = $sizes;
        return $this;
    }

    /**
    * getTouchSizes
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function getTouchSizes()
    {
        return (array) $this->touchSizes;
    }

    /**
    * setTouchPattern
    *
    * @param string $pattern pattern for sprintf (sizes)
    *
    * @return Icons
    *
    * @access public
    */
    public function setTouchPattern($pattern)
    {
        $this->touchPattern = $pattern;
        return $this;
    }

    /**
    * getTouchPattern
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function getTouchPattern()
    {
        return (string) $this->touchPattern;
    }

    /**
    * setFavicon
    *
    * @param string $favicon path to favicon
    *
    * @return Icons
    *
    * @access public
    */
    public function setFavicon($favicon)
    {
        $this->favicon = $favicon;
        return $this;
    }

    /**
    * getFavicon
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function getFavicon()
    {
        return (string) $this->favicon;
    }

    /**
    * getTouchArray
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function getTouchArray()
    {
        $sizes = $this->getTouchSizes();
        $pattern = $this->getTouchPattern();

        $data = [];
        foreach ($sizes as $size) {
            $data[] = [
                'rel' => 'apple-touch-icon-precomposed',
                'sizes' => "{$size}x{$size}",
                'href' => sprintf($pattern, $size)
            ];
        }
        return $data;
    }

    /**
    * doProcess
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    protected function doProcess()
    {
        $links = $this->links;

        foreach ($this->getTouchArray() as $touchIcon) {
            $links->add($touchIcon);
        }

        foreach (['icon', 'shortcut icon'] as $rel) {
            $links->add(
                [
                    'rel'  => $rel,
                    'href' => $this->getFavicon()
                ]
            );
        }

        return true;
    }

}



