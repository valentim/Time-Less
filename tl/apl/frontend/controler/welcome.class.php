<?php
/** 
 * @author thiagovalentim
 * 
 * 
 */
class frontend_controler_welcome extends TemplateControler {
	
	public function index() {
		$this->addData('header', array('title'=>'timeless'));
		$this->addView('template/content', array('content'=>'Welcome to the TimeLess'));
		$this->render();
	}
}

?>