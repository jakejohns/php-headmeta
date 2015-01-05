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
* @package   HeadMeta
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2014 Jake Johns
* @license   http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
* @link      http://jakejohns.net
 */

namespace Jnj\HeadMeta\Helper;

use Aura\Html\Helper\Title as AuraTitle;
use Aura\Html\Helper\Metas as AuraMetas;
use Aura\Html\Escaper;

/**
 * Title
 *
 * @category CategoryName
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
class Title
{
    use Traits\ProcessorTrait;


    protected $auraTitle;

    protected $auraMetas;

    protected $escaper;

    protected $titles = [];

    protected $siteTitle = '';

    protected $titleSeparator = ' - ';

    protected $includeMeta = true;

    protected $includeSiteName = true;


    /**
    * __construct
    *
    * @param AuraTitle $title   DESCRIPTION
    * @param AuraMetas $metas   DESCRIPTION
    * @param Escaper   $escaper DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function __construct(AuraTitle $title, AuraMetas $metas, Escaper $escaper)
    {
        $this->auraTitle = $title;
        $this->auraMeta = $metas;
        $this->escaper = $escaper;
    }

    /**
    * __invoke
    *
    * @param mixed $title title to add
    *
    * @return Title
    *
    * @access public
    */
    public function __invoke($title = null)
    {
        if ($title) {
            $this->addTitle($title);
        }
        return $this;
    }

    /**
    * __toString
    *
    * @return string
    *
    * @access public
    */
    public function __toString()
    {
        $this->process();
        $auraTitle = $this->auraTitle;
        return (string) $auraTitle();
    }

    /**
    * getMetaArray
    *
    * @param mixed $title DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function getMetaArray($title)
    {
        return [
            'name' => 'title',
            'property' => 'og:title',
            'content' => $title
        ];
    }

    /**
    * getSiteNameArray
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access protected
    */
    protected function getSiteNameArray()
    {
        return [
            'property' => 'og:site_name',
            'content' => $this->siteTitle
        ];
    }

    /**
    * doProcess
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function doProcess()
    {
        $title = $this->getTitleString();

        $this->auraTitle->setRaw($title);

        if ($this->includeMeta) {
            $this->auraMeta->add($this->getMetaArray($title));
        }
        if ($this->includeSiteName) {
            $this->auraMeta->add($this->getSiteNameArray());
        }

        return true;
    }

    /**
    * setIncludeSiteName
    *
    * @param bool $val include site name tag?
    *
    * @return Title
    *
    * @access public
    */
    public function setIncludeSiteName($val)
    {
        $this->includeSiteName = (bool) $val;
        return $this;
    }

    /**
    * setIncludeMeta
    *
    * @param bool $val include meta tag?
    *
    * @return Title
    *
    * @access public
    */
    public function setIncludeMeta($val)
    {
        $this->includeMeta = (bool) $val;
        return $this;
    }

    /**
    * setSiteTitle
    *
    * @param string $txt site title
    *
    * @return Title
    *
    * @access public
    */
    public function setSiteTitle($txt)
    {
        $this->siteTitle = $txt;
        return $this;
    }

    /**
    * setTitleSeparator
    *
    * @param string $string title part separator
    *
    * @return Title
    *
    * @access public
    */
    public function setTitleSeparator($string)
    {
        $this->titleSeparator = $string;
        return $this;
    }

    /**
    * getTitleString
    *
    * @return string
    *
    * @access public
    */
    public function getTitleString()
    {
        $sep = $this->titleSeparator;
        $raw = trim(
            implode(
                $sep,
                [
                    implode($sep, $this->titles),
                    $this->siteTitle
                ]
            ),
            $sep
        );
        return $this->escaper->html($raw);
    }

    /**
    * title
    *
    * @param string $string title part to add
    *
    * @return Title
    *
    * @access public
    */
    public function addTitle($string)
    {
        array_unshift($this->titles, $string);
        return $this;
    }

}

