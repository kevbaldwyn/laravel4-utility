<?php namespace KevBaldwyn\Utility;

// \De::bug($var);

use Log;

class De {

	public function bug($var, $die = false, $return = false, $message = 'Debug') {
		Log::debug($message, array('data'   => $var,
								   'die'    => $die,
								   'return' => $return));
	}

}