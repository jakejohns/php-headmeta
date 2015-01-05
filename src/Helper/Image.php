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
* @package   Helpers
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2015 Jake Johns
* @license   http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
* @link      http://jakejohns.net
 */

namespace Jnj\HeadMeta\Helper;

use Aura\Html\Helper\Links as AuraLinks;
use Aura\Html\Helper\Metas as AuraMeta;

/**
 * Image
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
class Image
{

    use Traits\ProcessorTrait;

    protected $links;
    protected $meta;

    protected $value;

    /**
    * __construct
    *
    * @param AuraMeta  $meta  DESCRIPTION
    * @param AuraLinks $links DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function __construct(AuraMeta $meta, AuraLinks $links)
    {
        $this->links = $links;
        $this->meta = $meta;
    }

    /**
    * setValue
    *
    * @param mixed $value DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function setValue($value)
    {
        $this->value = $value;
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
        $meta = $this->meta;

        if ($this->value) {
            $links->add(
                [
                    'rel'  => 'image_src',
                    'href' => $this->value
                ]
            );
            $meta->add(
                [
                    'name' => 'image',
                    'property' => 'og:image',
                    'content' => $this->value
                ]
            );
        }

        return true;
    }

}
