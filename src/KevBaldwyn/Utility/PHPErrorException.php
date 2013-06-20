<?php
namespace KevBaldwyn\Utility;

use App;
use Log;
use Mail;
use Config;

class PHPErrorException {
	
	public static function report($exception) {
		
		if($exception instanceof \Symfony\Component\Debug\Exception\FatalErrorException) {
			Log::emergency($exception);

			// if not setup for debug mode then send an email
			if(!Config::get('app.debug')) {
				
				Mail::send(Config::get('debugger::mail.template'), array('execption' => $execption->__toString()), function($message) {
					$from = Config::get('mail.from');

				    $message->from($from['address'], $from['name']);
				    $message->to(Config::get('mail.to'))->subject(Config::get('debugger::mail.subject.error-exception'));

				});

			}
		}
		
	}

	
}

?>