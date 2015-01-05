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
* @package   HeadMEta
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2014 Jake Johns
* @license   http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
* @link      http://jakejohns.net
 */


namespace Jnj\HeadMeta\Helper\Traits;

use Jnj\HeadMeta\Helper\Exception\MultiProcessException;
use Aura\Html\Helper\Metas;

/**
 * MetaPropertyTraits
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
trait MetaPropertyTrait
{
    use ProcessorTrait;

    /**
     * value
     *
     * @var mixed
     * @access protected
     */
    protected $value;

    /**
     * default
     *
     * @var mixed
     * @access protected
     */
    protected $default;

    /**
     * metas
     *
     * @var Aura\Html\Helper\Metas
     * @access protected
     */
    protected $metas;

    /**
    * __construct
    *
    * @param Metas $metas DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function __construct(Metas $metas)
    {
        $this->metas = $metas;
        $this->setDefault($this->initDefault());
    }

    /**
    * initDefault
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function initDefault()
    {
        return null;
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
        if ($this->isValid($value)) {
            $this->value = $value;
        }
        return $this;
    }

    /**
    * isValid
    *
    * @param mixed $value DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function isValid($value)
    {
        $value;
        return true;
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
        return ($this->value === null ? $this->getDefault() : $this->value);
    }

    /**
    * clearValue
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function clearValue()
    {
        $this->value = null;
        return $this;
    }

    /**
    * setDefault
    *
    * @param mixed $default DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function setDefault($default)
    {
        $this->default = $default;
        return $this;
    }

    /**
    * getDefault
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function getDefault()
    {
        return $this->default;
    }

    /**
    * clearDefault
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function clearDefault()
    {
        $this->default = null;
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
        return ['content' => $this->getValue()];
    }

    /**
    * getPosition
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function getPosition()
    {
        return 100;
    }

    /**
    * doProcess
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function doProcess()
    {
        if ($this->getValue()) {
            $this->metas->add($this->toArray(), $this->getPosition());
            return true;
        }
        return false;
    }

    /**
    * __invoke
    *
    * @param mixed $value DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function __invoke($value = null)
    {
        if ($value !== null) {
            $this->setValue($value);
        }
        return $this;
    }

}


