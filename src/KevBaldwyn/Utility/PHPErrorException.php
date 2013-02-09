<?php
namespace KevBaldwyn\Utility;

use Log;
use Config;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use KevBaldwyn\Utility\Debug;
use \php_error\ErrorHandler;

class PHPErrorException {
	
	public static function report($exception, $code = false) {
		
		Log::error($exception);

		if(Config::get('app.debug')) {
			
			ini_set('display_errors', '1');
					
			$flatten = FlattenException::create($exception, $code);
						
			$handler = new ErrorHandler(array('application_root' => str_replace('/public', '', $_SERVER['DOCUMENT_ROOT'])));
			$handler->turnOn();
			$handler->addOutputArray('Debug:log', Debug::getLog());
			$handler->reportError($flatten->getCode(), $flatten->getMessage(), $flatten->getLine(), $flatten->getFile(), $exception);

		}
		
	}
	
}

?>