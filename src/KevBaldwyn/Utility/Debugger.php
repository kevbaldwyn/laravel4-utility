<?php
namespace KevBaldwyn\Utility;

use Config;
use View;

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
			ob_start();
			foreach($this->log as $var) {
				$this->pa($var);
			}
			$output = ob_get_contents();
			ob_end_clean();
			
			/*
			$str = '<div id="debugger">';
			$str .= $output;
			$str .= '</div>';
			return $str;
			*/
			return View::make('laravel4-utility::debugger.log', compact('output'));
			
		}
		
	}
	
	public function getLog() {
		return $this->log;
	}
	
}

?>