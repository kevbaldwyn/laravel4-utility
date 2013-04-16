<?php 
namespace KevBaldwyn\Utility\Providers;

use Illuminate\Support\ServiceProvider;
use KevBaldwyn\Utility\Debugger;
use KevBaldwyn\Utility\PHPErrorException;
//use Symfony\Component\HttpKernel\Exception\ErrorException;

class UtilityServiceProvider extends ServiceProvider {

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
		$this->package('kevbaldwyn/laravel4-utility');
		
		// on app finish output the debug log
		$app = $this->app;
        $this->app->finish(function($request, $response) use ($app) {
        	// don't add the debug log if this is a json response
        	if(!str_contains($response->headers->__toString(), '/json')) {
            	echo $app['debugger']->outputLog();
            }
        });
		
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// create the shared binding
		$this->app['debugger'] = $this->app->share(function($app) {
			return new Debugger;
		});
		
		// incldue the start file
		include(__DIR__.'/../start.php');
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('laravel4-utility', 'debugger');
	}

}