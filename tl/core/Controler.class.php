<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Controler {
	protected $action;
	protected $response;
	
	public function __construct($action) {
		$this->action = $action;
		if(!method_exists($this, $this->action)) {
			throw new Exception("Action não existe");
		}
		call_user_func(array($this, $this->action));
	}
	
	protected function render($file, array $data) {
		$this->response = new Response($file, $data);	
	}
	
	public function __toString() {
		return (string) $this->response->getResponse();
	}
}

?>