<?php
/** 
 * @author thiagovalentim
 * 
 * 
 */
class controler_welcome extends Controler {
	
	public function index() {
		$this->render('index', array('facebook'=>123));
	}
}

?>