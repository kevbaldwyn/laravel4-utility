<?php namespace KevBaldwyn\Utility\Facades;

use Illuminate\Support\Facades\Facade;

class Debugger extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'debugger'; }

}