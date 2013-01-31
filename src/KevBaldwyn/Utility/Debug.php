<?php
namespace KevBaldwyn\Utility;

use Config;

class Debug {
	
	private static $log = array();
	
	public static function pa($var, $die = false) {
		if(Config::get('app.debug')) {
			echo '<pre>';
			if(is_array($var)) {
				print_r($var);
			}else{
				var_dump($var);
			}
			echo '</pre>';
			if($die) {
				die();
			}
		}
	}
	
	public static function log($var) {
		self::$log[] = $var;
	}
	
	public static function outputLog() {
		if(Config::get('app.debug')) {
			foreach(self::$log as $var) {
				self::pa($var);
			}
		}
	}
	
	public static function getLog() {
		return self::$log;
	}
	
}

?>