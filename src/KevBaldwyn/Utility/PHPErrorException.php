<?php
namespace KevBaldwyn\Utility;

use Log;
use Mail;
use Config;
use View;

class PHPErrorException {
	
	public static function report($exception) {
		
		if($exception instanceof \Symfony\Component\Debug\Exception\FatalErrorException) {
			Log::emergency($exception);

			// if not setup for debug mode then send an email
			if(!Config::get('app.debug')) {

				$profile = Debugger::getRequestLog();
				
				Mail::send(Config::get('laravel4-utility::mail.template'), array('exception' => $exception->__toString(), 'profile' => $profile->__toString()), function($message) {

					if(Config::get('laravel4-utility::mail.from') == 'default') {
						$from = Config::get('mail.from');
					}else{
						$from = Config::get('laravel4-utility::mail.from');
					}

				    $message->from($from['address'], $from['name']);
				    $message->to(Config::get('laravel4-utility::mail.to'))->subject($_SERVER['HTTP_HOST'] . ': ' . Config::get('laravel4-utility::mail.subject.error-exception'));

				});

			}

		}
		
	}

	
}

?>