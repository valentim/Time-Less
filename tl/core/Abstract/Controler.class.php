<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Abstract_Controler {
	
	protected $action;
	protected $response;
	protected $view = array();
	
	public function __construct($action) {
		$this->action = $action;
		if(!method_exists($this, $this->action)) {
			throw new Exception("Action não existe");
		}
		call_user_func(array($this, $this->action));
	}
	
	protected function addView($file, array $data = array()) {
		array_push($this->view, array($file=>$data));
	}
	
	protected function render() {
		$this->response = new Response($this->view);	
	}
	
	public function __toString() {
		return (string) $this->response->getResponse();
	}
}

?>