<?php
/** 
 * @author thiagovalentim
 * 
 * 
 */
class controler_welcome extends Controler {
	
	public function index() {
		//$facebook = new Facebook_Init(array('appId'=>'225819700810258', 'secret'=>'1d3f264d559c8be86320e6e184983a36'));
		$this->addView('template/header', array('title'=>'timeless'));
		$this->addView('template/content', array('content'=>'Welcome to the TimeLess'));
		$this->addView('template/footer');
		$this->render();
	}
}

?>