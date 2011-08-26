<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class core_registry {
	private static $instance;
	private $param = array();
	
	private function __construct($key, $valor) {
		$this->param[$key] = $valor;
	}
	
	public static function getInstance($key, $valor) {
		if(empty(self::$instance)) {
			self::$instance = new self($key, $valor);
		}
		return self::$instance;
	}
	
	public function get($key) {
		return $this->param[$key];
	}
}

?>