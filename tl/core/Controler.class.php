<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class Controler {
	protected $action;
	protected $response;
	
	public function __construct($a) {
		$this->action = $a;
		if(!method_exists($this, $this->action)) {
			throw new Exception("Action n‹o existe");
		}
		call_user_func(array($this, $this->action));
	}
	
	protected function render($file, array $data) {
		$file = "tl".DIRECTORY_SEPARATOR."apl".DIRECTORY_SEPARATOR."view".DIRECTORY_SEPARATOR.$file.".php";

		if(is_file($file)) {
			extract($data, EXTR_SKIP);
			
			/* Inicia Buffer para guardar as variaveis 
			 * Exemplo array('url'=>'/');
			 * resulta na variavel $url
			 */ 
			ob_start();
			include realpath($file);
		} else {
			echo "arquivo n‹o encontrado";
		}
		
		$this->response = ob_get_clean();
		
	}
	
	public function __toString() {
		return (string) $this->response;
	}
}

?>