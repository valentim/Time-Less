<?php
/** 
 * @author thiagovalentim
 * 
 * 
 */
class controler_welcome extends Controler {
	
	public function index() {
		$this->addView('template/header', array('facebook'=>123));
		$this->addView('template/content', array('facebook2'=>456));
		$this->addView('template/footer', array('facebook3'=>789));
		$this->render();
	}
}

?>