<?php namespace KevBaldwyn\Utility;

// \De::bug($var);

use Log;

class De {

	public function bug($var, $die = false, $return = false, $message = 'Debug') {
		$context = array('data' => $var);
		if($die) {
			$context['die'] = $die;
		}
		if($return) {
			$context['return'] = $return;
		}
		Log::debug($message, $context);
	}

}