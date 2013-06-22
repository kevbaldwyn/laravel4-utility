<?php 
namespace KevBaldwyn\Utility\Providers;

use Illuminate\Support\ServiceProvider;
use KevBaldwyn\Utility\Debugger;
use KevBaldwyn\Utility\De;
use KevBaldwyn\Utility\PHPErrorException;
use KevBaldwyn\Utility\PackageMigrationCommand;

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
            	echo $app['utility.debugger']->outputRequestLog();
            }
        });
		
		\App::error(function($exception) {
			
			$reportResult = \KevBaldwyn\Utility\PHPErrorException::report($exception);
			
			$data = array();
			if($reportResult instanceof \Exception) {
				$data['additional_errors'][] = 'Could not report error: ' . $reportResult->getMessage();
			}

			return \KevBaldwyn\Utility\PHPErrorException::view($data);

		});
		

		// pass off any log events to a debug service so we can choose if we want to output them to the browser as well
		\Log::listen(function($level, $message, $context) use ($app) {
		    $app['utility.debugger']->dump($level, $message, $context);
		});


	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		\Config::package('kevbaldwyn/laravel4-utility', __DIR__.'/../../../config');
		
		$this->app->instance('utility.debugger', new Debugger());
		$this->app->instance('laravel4-utuility.de', new De());
		
		$this->app['command.kevbaldwyn.migrate-packages'] = $this->app->share(function($app) {
			return new PackageMigrationCommand($app);
		});
				
		$this->commands('command.kevbaldwyn.migrate-packages');
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('laravel4-utility.debugger');
	}

}