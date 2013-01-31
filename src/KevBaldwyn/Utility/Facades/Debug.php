<?php namespace KevBaldwyn\Utility\Facades;

use Illuminate\Support\Facades\Facade;

class Debug extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'debug'; }

}