<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Registry {
	private static $instance;
	private $registry;
	
	private function __construct() {
		$this->registry = new ArrayObject();
	}
	
	public static function getInstance() {
		if(empty(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function set($key, $valor) {
		if(!$this->registry->offsetExists($key)) {
			$this->registry->offsetSet($key, $valor);
		} else {
			throw new LogicException("Chave ja registrada");
		}
	}
	
	public function get($key) {
		if($this->registry->offsetExists($key)){
			return $this->registry->offsetGet($key);
		} else {
			throw new LogicException("Registro não encontrado");
		}
	}
}

?>