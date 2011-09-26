<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Request {
	private $uri;
	private $controller;
	private $action;
	private $param = array();
	private $registry;
	
	public function __construct() {
		$this->registry = Registry::getInstance();
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->dismemberUri();
		
	}
	
	public function getController() {
		$controler = "controler_";
		$controler .= (isset($this->uri[1])) ? $this->uri[1] : $this->registry->get('controller'); 
		return $controler;
	}
	
	public function getAction() {
		return (isset($this->uri[2])) ? $this->uri[2] : $this->registry->get('action');
	}
	
	public function getParam() {
		foreach ($this->uri as $key => $param) {
			if($key > 2) {
				array_push($this->param, $param);
			}
		}
		return $this->param;
	}
	
	private function dismemberUri() {
		$this->uri = substr_replace($this->uri, ' ', -strlen($this->uri), 1);
		if(strrpos($this->uri, '/') == (strlen($this->uri) - 1)) {
			$this->uri = substr_replace($this->uri, ' ', (strlen($this->uri) - 1), strlen($this->uri) );
		}
		$this->uri = explode("/", trim($this->uri));
	}
}
