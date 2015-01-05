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
* @category  Jnjlv
* @package   ServiceProvider
* @author    Jake Johns <jake@jakejohns.net>
* @copyright 2014 Jake Johns
* @license   http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
* @link      http://jakejohns.net
 */


namespace Jnj\HeadMeta\_Config;

use \Jnj\HeadMeta\MetaHelperFactory;
use \Illuminate\Support\ServiceProvider;

/**
 * JnjlvServiceProvider
 *
 * @category Jnjlv
 * @package  PackageName
 * @author   Jake Johns <jake@jakejohns.net>
 * @license  http://www.gnu.org/licenses/gpl-3.0.txt GPL V3
 * @version  Release: @package_version@
 * @link     http://jakejohns.net
 *
 * @see      ServiceProvider
 */
class LaravelServiceProvider extends ServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['aura/html:helper'] = $this->app->share(
            function ($app) {
                $app;
                $factory = new \Aura\Html\HelperLocatorFactory;
                return $factory->newInstance();
            }
        );

        $this->app['aura/html:escaper'] = $this->app->share(
            function ($app) {
                $app;
                $factory = new \Aura\Html\EscaperFactory();
                return $factory->newInstance();
            }
        );

        $this->app['jnj/php-headmeta:helper'] = $this->app->share(
            function ($app) {
                $factory = new MetaHelperFactory(
                    $app->make('aura/html:helper'),
                    $app->make('aura/html:escaper')
                );
                return $factory->newInstance();
            }
        );

        $this->app->booting(
            function () {
              $loader = \Illuminate\Foundation\AliasLoader::getInstance();
              $loader->alias('AuraHtml', 'Jnj\HeadMeta\Facades\AuraHtmlHelper');
              $loader->alias('Meta', 'Jnj\HeadMeta\Facades\MetaHelper');
            }
        );
	}

}


