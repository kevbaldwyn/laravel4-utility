<?php
namespace KevBaldwyn\Utility;

use Config;
use Illuminate\View\Environment;

class Debugger {
	
	private $log = array();
	
	/**
     * Illuminate view environment.
     * 
     * @var Illuminate\View\Environment
     */
    protected $logView;
    
    /**
     * Create a new debug instance.
     * 
     * @param  Illuminate\View\Environment  $logView
     * @return void
     */
    public function __construct(Environment $logView) {
        $this->logView = $logView;
    }
    
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
			foreach($this->log as $var) {
				$this->pa($var);
			}
		}
	}
	
	public function getLog() {
		return $this->log;
	}
	
}

?>