<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Response {
	private $response;
	private $file;
	private $data;
	
	public function __construct($file, $data) {
		$view = new View($file);
		$this->file = $view->getRealPath();
		$this->data = $data;
		$this->saveResponse();
	}
	
	public function getResponse() {
		return $this->response;
	}
	
	private function saveResponse() {	
		try {
			if(is_file($this->file)) {
				$this->saveBuffer();
			}
		} catch (ErrorException $e) {
			$this->response =  $e->getMessage();
		}	
	}
	
	private function saveBuffer() {
		extract($this->data, EXTR_SKIP);
			
		/* Inicia Buffer para guardar as variaveis 
		 * Exemplo array('url'=>'/');
		 * resulta na variavel $url
		 */ 
		ob_start();
		include $this->file;
		$this->response = ob_get_clean();
	}
}