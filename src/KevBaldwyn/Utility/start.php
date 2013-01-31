<?php
/**
 * define an error handler
 */
App::error(function(ErrorException $exception, $code)
{
	KevBaldwyn\Utility\PHPErrorException::report($exception, $code);
});

?>