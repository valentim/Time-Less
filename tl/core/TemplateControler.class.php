<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class TemplateControler extends Abstract_Controler {
	
	protected $data = array(
							'header' => array(),
							'footer' => array()
							);
	
	protected function addView($file, array $data = array(), $path = null) {
		
		if(isset($path)) {
			$path .= '/';
		}

		array_push($this->view, array($path.'template/header'=> $this->data['header']));
		array_push($this->view, array($path.$file=>$data));
		array_push($this->view, array($path.'template/footer'=> $this->data['footer']));
	}
	
	protected function addData($view, array $data) {
		$this->data[$view] = array_merge($this->data[$view], $data);	
	}
	
	protected function addSingleView($file, $data) {
		parent::addView($file, $data);
	}
	
}

?>