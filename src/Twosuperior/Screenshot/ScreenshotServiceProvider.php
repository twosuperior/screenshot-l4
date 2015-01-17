<?php namespace Twosuperior\Screenshot;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
	
class ScreenshotServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('twosuperior/screenshot');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
	{
		$this->app->register('Intervention\Image\ImageServiceProvider');
		
		$this->app['screenshot'] = $this->app->share(function($app)
		{
		    return new Screenshot;
		});
		
		$this->app->booting(function()
		{
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Screenshot', 'Twosuperior\Screenshot\Facades\Screenshot');
		});
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('screenshot');
    }
}