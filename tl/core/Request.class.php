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
		return $this->controler;
	}
	
	public function getAction() {
		$this->setParam();
		return (isset($this->uri[1])) ? $this->uri[1] : $this->registry->get('action');
	}
	
	private function setParam() {
		foreach ($this->uri as $key => $param) {
			if($key > 1) {
				array_push($this->param, $param);
			}
		}
		$this->registry->set('params', $this->param);
	}
	
	private function dismemberUri() {
		$url = parse_url($this->registry->get('url'));
		$this->uri = str_replace($url['path'], "/", $this->uri);
		$this->uri = substr_replace($this->uri, "", -strlen($this->uri), 1);
		$this->uri = preg_replace("/\/?[?]\S+/", "/index", $this->uri);

		if(strrpos($this->uri, '/') == (strlen($this->uri) - 1)) {
			$this->uri = substr_replace($this->uri, ' ', (strlen($this->uri) - 1), strlen($this->uri) );
		}
		
		$this->uri = explode("/", trim($this->uri));
		$this->delegateControler();
	}
	
	private function delegateControler() {
		
		if(isset($this->uri[0]) && preg_match("/{$this->registry->get('admin')}/", $this->uri[0])) {
			$this->registry->set('path', 'backend');
		} else {
			$this->registry->set('path', 'frontend');
		}
		$this->controler = $this->registry->get('path').'_controler_';
		$this->controler .= (isset($this->uri[0]) && $this->uri[0] != '') ? $this->uri[0] : $this->registry->get('controller'); 
	}
}
