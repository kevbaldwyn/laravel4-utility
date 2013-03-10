<?php 
namespace KevBaldwyn\Utility\Providers;

use Illuminate\Support\ServiceProvider;
use KevBaldwyn\Utility\Debug;
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
		$this->package('kevbaldwyn/utility');
		
		// on app finish output the debug log
        $this->app->finish(function() use ($app) {
            Debug::outputLog();
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
		$this->app['debug'] = $this->app->share(function($app) {
			return new Debug();
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
		return array('utility');
	}

}