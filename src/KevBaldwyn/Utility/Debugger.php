<?php
namespace KevBaldwyn\Utility;

use Config;
use View;
use Session;
use \php_error\ErrorHandler;

class Debugger {
	
	private $log = array();
	
	/**
     * Illuminate view environment.
     * 
     * @var Illuminate\View\Environment
     */
    //protected $logView;
    
    /**
     * Create a new debug instance.
     * 
     * @param  Illuminate\View\Environment  $logView
     * @return void
     */
     /*
    public function __construct(Environment $logView) {
        $this->logView = $logView;
    }
    */
    
    public function pa($var, $die = false) {
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
	
	public function log($var) {
		$this->log[] = $var;
	}
	
	public function outputLog() {
		if(Config::get('app.debug')) {
			
			// get output css
			ob_start();
			ErrorHandler::css();
			$css = ob_get_contents();
			ob_end_clean();
			
			$logHtml =  ErrorHandler::getRequestFullRequest(array('session' => Session::getSession(),
																  'Debugger:log' => $this->log));
			
			return View::make('laravel4-utility::debugger.log', compact('logHtml', 'css'));
			
		}
		
	}
	
	public function getLog() {
		return $this->log;
	}
	
}

?>