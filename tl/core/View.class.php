<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class View {
	private $view;
	
	public function __construct($view) {
		$this->view = $view;
		$this->setRealPath();
	}
	
	public function getRealPath() {
		return $this->view;
	}
	
	private function setRealPath() {
		$this->view = realpath("tl".DIRECTORY_SEPARATOR."apl".DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR.$this->view.".php");	
	}
}

?>