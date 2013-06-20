<?php

return array(

	'mail' => array(
	
		/**
		 * array('email', 'name')
		 * to set a custom email from field for sending emails from the package (password reset etc) use this
		 * to use the default configuration in laravel set to 'default'
		 */
		'from' => 'default',

		'to' => '',

		'subject' => array(
			'error-exception' => 'An error was recorded'
		),

		'template' => 'debugger::emails.error-exception'
	)
);