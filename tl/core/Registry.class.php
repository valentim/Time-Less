<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Registry {
	private static $registry;
	
	private function __construct() {}
	
	public static function add($key, $valor) {
		self::$registry[$key] = $valor;
	}
	
	
	public static function get($key) {
		return self::$registry[$key];
	}
}

?>