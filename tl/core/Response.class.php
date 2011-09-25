<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Response {
	private $response;
	private $file;
	private $totalViews;
	
	public function __construct($file) {
		$view = new View($file);
		$this->file = $view->getRealPath();
		$this->totalViews = count($file);
		$this->saveResponse();
	}
	
	public function getResponse() {
		return $this->response;
	}
	
	private function saveResponse() {	
		try {
			foreach ($this->file as $view) {
				$key = array_keys($view);
				$value = array_values($view);
				if(is_file($key[0])) {
					$this->saveBuffer($key[0], $value[0]);
				}
			}
		} catch (ErrorException $e) {
			$this->response =  $e->getMessage();
		}	
	}
	
	private function saveBuffer($view, $data) {
		extract($data, EXTR_SKIP);
			
		/* Inicia Buffer para guardar as variaveis 
		 * Exemplo array('url'=>'/');
		 * resulta na variavel $url
		 */ 
		ob_start();
		include $view;
		$this->response = ob_get_flush();
	}
}