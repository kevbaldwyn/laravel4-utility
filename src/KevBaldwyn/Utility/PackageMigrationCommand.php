<?php namespace KevBaldwyn\Utility;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PackageMigrationCommand extends Command {


	protected $name = 'kevbaldwyn:migrate-packages';
	protected $description = 'Migrate all packages';
	
	protected $app;
	
	
	public function __construct($app) {
		parent::__construct();
		
		$this->app = $app;
		
	}
	
	public function fire() {
		
		$this->info('Reading packages...');
		
		// get all packages
		$vendorsDir = $this->app['path.base'] . '/vendor/';
		$dh = new \DirectoryIterator($vendorsDir);
		
		// the vendors
		foreach($dh as $dirInfo) {
			if($dirInfo->isDir() && !$dirInfo->isDot()) {
				
				$vendorName = $dirInfo->getFilename();
				$packageDh = new \DirectoryIterator($dirInfo->getPathname());
				
				// the packages
				foreach($packageDh as $packageInfo){
					$packageName = $packageInfo->getFilename();
					
					// if it has a migrations directory try and migrate it
					if(is_dir($packageInfo->getPathname() . '/src/migrations/')) {
						$this->info('Migrating: ' . $vendorName . '/' . $packageName . '...');
						$this->call('migrate', array('--package' => $vendorName . '/' . $packageName));
					}
				}
			}
		}

		$this->info('Done.');
		
	}

	protected function getArguments() {
		return array();
	}

	protected function getOptions() {
		return array(
			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}