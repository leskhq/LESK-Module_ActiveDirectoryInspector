<?php
namespace App\Modules\ActiveDirectoryInspector\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class ActiveDirectoryInspectorServiceProvider extends ServiceProvider
{
	/**
	 * Register the ActiveDirectoryInspector module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\ActiveDirectoryInspector\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the ActiveDirectoryInspector module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('activedirectoryinspector', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('activedirectoryinspector', base_path('resources/views/vendor/activedirectoryinspector'));
		View::addNamespace('activedirectoryinspector', realpath(__DIR__.'/../Resources/Views'));
	}

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('activedirectoryinspector.php'),
        ], 'config');

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'activedirectoryinspector'
        );
    }

}
