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

use Jnj\HeadMeta\Helper\Exceptions\MultiProcessException;
use Aura\Html\Helper\Metas;

/**
 * ProcessorTrait
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
trait ProcessorTrait
{

    /**
     * processed
     *
     * @var mixed
     * @access protected
     */
    protected $processed = false;

    /**
    * isProcessed
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function isProcessed()
    {
        return (bool) $this->processed;
    }

    /**
    * setProcessed
    *
    * @param mixed $val DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function setProcessed($val = true)
    {
        $this->processed = (bool) $val;
        return $this;
    }

    /**
    * process
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function process()
    {
        if ($this->isProcessed()) {
            throw new MultiProcessException('Already Processed!');
        }

        if ($this->doProcess()) {
            $this->setProcessed(true);
        }

        return $this;
    }

    /**
    * doProcess
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    abstract protected function doProcess();

}


