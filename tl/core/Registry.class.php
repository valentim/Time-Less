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
		if(array_key_exists($key, self::$registry)){
			return self::$registry[$key];
		}
		return null;
	}
}

?>