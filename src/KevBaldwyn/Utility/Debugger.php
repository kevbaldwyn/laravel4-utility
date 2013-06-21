<?php
namespace KevBaldwyn\Utility;

use Config;
use View;
use \php_error\ErrorHandler;
use Psr\Log\LogLevel;

class Debugger {

    
    public function pa($var, $die = false, $return = false, $message = null) {
		if(Config::get('app.debug')) {
			ob_start();
			
			echo '<pre>';
			if(!is_null($message)) {
				echo $message . ":\n";
			}
			if(is_array($var)) {
				print_r($var);
			}else{
				var_dump($var);
			}
			echo '</pre>';
			
			$out = ob_get_contents();
			ob_end_clean();
			
			if($die) {
				die($out);
			}elseif($return) {
				return $out;
			}else{
				echo $out;
			}
			
		}
	}


	public function dump($level, $message, $context) {
		
		if($level == LogLevel::DEBUG) {
			$die    = (array_key_exists('die', $context)) ? $context['die'] : false;
			$return = (array_key_exists('return', $context)) ? $context['return'] : false;
			static::pa($context['data'], $die, $return, $message);
		}
		
	}

	
	public function outputRequestLog() {

		if(Config::get('app.debug')) {

			return View::make('laravel4-utility::debugger.log');
			
		}
		
	}
	
}

?>