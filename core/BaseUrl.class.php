<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class BaseUrl {
	
    private static $instance;
    private $baseurl;
	
	private function __construct($url) {
		$this->baseurl = $url;
	}
	
	public static function getInstance($url) {
		if(empty(self::$instance)) {
			self::$instance = new self($url);
		}
		
		return self::$instance;
	}
	
	public function getUrl() {
		return $this->baseurl;
	}
	
}

?>