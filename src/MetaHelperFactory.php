<?php
/**
* jnj/php-headmeta
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

namespace Jnj\HeadMeta;

use Aura\Html\HelperLocator as AuraHelperLocator;
use Aura\Html\Escaper as AuraExcaper;

/**
 * HelperLocatorFactory
 *
 * @category HeadMeta
 * @package  HeadMeta
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 */
class MetaHelperFactory
{
    protected $aura;
    protected $escaper;

    /**
    * __construct
    *
    * @param AuraHelperLocator $aura    DESCRIPTION
    * @param AuraEscaper       $escaper DESCRIPTION
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function __construct(
        AuraHelperLocator $aura = null,
        AuraEscaper $escaper = null
    ) {
        $this->aura = $aura;
        $this->escaper = $escaper;
    }

    /**
    * newInstance
    *
    * @return mixed
    * @throws exceptionclass [description]
    *
    * @access public
    */
    public function newInstance()
    {
        $escaper = $this->escaper;
        $aura = $this->aura;

        return new HelperLocator(
            [
                'title' => function () use ($aura, $escaper) {
                    return new Helper\Title(
                        $aura->get('title'),
                        $aura->get('metas'),
                        $escaper
                    );
                },
                'description' => function () use ($aura) {
                    return new Helper\Description(
                        $aura->get('metas')
                    );
                },
                'robots' => function () use ($aura) {
                    return new Helper\Robots(
                        $aura->get('metas')
                    );
                },
                'icons' => function () use ($aura) {
                    return new Helper\Icons(
                        $aura->get('links')
                    );
                },
                'charset' => function () use ($aura) {
                    return new Helper\Charset(
                        $aura->get('metas')
                    );
                },
                'compat' => function () use ($aura) {
                    return new Helper\Compat(
                        $aura->get('metas')
                    );
                },
                'viewport' => function () use ($aura) {
                    return new Helper\Viewport(
                        $aura->get('metas')
                    );
                },
                'url' => function () use ($aura) {
                    return new Helper\Url(
                        $aura->get('metas')
                    );
                },
                'locale' => function () use ($aura) {
                    return new Helper\Loc(
                        $aura->get('metas')
                    );
                },
                'container' => function () use ($escaper) {
                    return new Helper\Container($escaper);
                },
                'metas' => function () use ($aura) {
                    return $aura->get('metas');
                },
                'links' => function () use ($aura) {
                    return $aura->get('links');
                },
                'scripts' => function () use ($aura) {
                    return $aura->get('scripts');
                },
                'scriptsFoot' => function () use ($aura) {
                    return $aura->get('scriptsFoot');
                },
                'styles' => function () use ($aura) {
                    return $aura->get('styles');
                }
            ]
        );

    }
}


