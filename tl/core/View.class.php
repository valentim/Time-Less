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
		$i = 0;
		foreach ($this->view as $view) {
			$key = array_keys($view);
			$value = array_values($view);
			$file = realpath("tl/apl/".Registry::getInstance()->get('path')."/view/{$key[0]}.php");
			$this->replaceKeysWithRealpath($i++, $key[0], array($file=>$value[0]));
		}
	}
	
	private function replaceKeysWithRealpath($index, $key, $newKey) {
		unset($this->view[$index]);
		array_push($this->view, $newKey);
	}
}

?>