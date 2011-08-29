<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Controler {
	protected $action;
	
	public function __construct($a) {
		$this->action = $a;
		if(!method_exists($this, $this->action)) {
			throw new Exception("Action n‹o existe");
		}
		call_user_func(array($this, $this->action));
	}
	
	protected function dispatch() {
		
	}
}

?>