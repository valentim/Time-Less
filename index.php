<?php
/**
 * Time Less
 * 
 * Este arquivo contem configurações iniciais do microframework
 * é o bookstrap do Time Less e está em fase de testes gerais, principalmente
 * de performace.
 * 
 */

/*
 * Set comportamento dos erros
 */
 error_reporting(E_ALL);
 
 /*
  * Definição dos diretórios da aplicação
  */
 define('APPLICATION_PATH', realpath(dirname(__FILE__)));
 define('MAINDIR', DIRECTORY_SEPARATOR.'tl'.DIRECTORY_SEPARATOR);
 
 $aplication = APPLICATION_PATH.MAINDIR.'apl'.DIRECTORY_SEPARATOR;
 $core = APPLICATION_PATH.MAINDIR.'core'.DIRECTORY_SEPARATOR;
 $modules = APPLICATION_PATH.MAINDIR.'mod'.DIRECTORY_SEPARATOR;
 $main = APPLICATION_PATH.MAINDIR;
 
 /*
  * Set Include Path
  */
 $path = array(
 	$aplication,
 	$core,
 	$modules,
 	$main
 );
 
 set_include_path(implode(PATH_SEPARATOR, $path));
 
 /*
  * Registrando tratador de erros
  */
 if(!function_exists('exception_handler')) {
	 function exception_handler($exception) {
	  echo "Uncaught exception: " , $exception->getMessage(), "\n";
	}	
	set_exception_handler('exception_handler');
 }
 
 if(!function_exists('error_handler')) {
	 function error_handler($errno, $errstr, $errfile, $errline) {
	  	die("error: $errno, $errstr, $errfile, $errline");
	}
	//Use our custom handler
	set_error_handler('error_handler');
 }
 
 /*
  * Registrando Funções
  */
 if(!function_exists('loader')) {
 	
 	/*
	 * Configura autoloader
	 */ 
	function loader($className) {
		$fileParts = explode('\\', ltrim($className, '\\'));
	    if (false !== strpos(end($fileParts), '_')) {
	        array_splice($fileParts, -1, 1, explode('_', current($fileParts)));
	    }
	    
	    require_once implode(DIRECTORY_SEPARATOR, $fileParts) . '.class.php';
	}
	spl_autoload_register('loader');
 }
 
 /*
  * Define a url
  */
$registry = Registry::getInstance();
$registry->set('url', 'http://'.$_SERVER['SERVER_NAME'].'/timeLess/');

/*
 * Define theme skin
 */
$registry->set('skin', $registry->get('url').'theme');

/*
 * Define Controller e Action Iniciais
 */
$registry->set('controller', 'welcome');
$registry->set('action', 'index');

/*
 * Define Banco de dados
 */
$registry->set("mysql", new database_pdo("mysql:host=127.0.0.1;dbname=timeless","root", "asdf"));

$request = new Request();
$controler = $request->getController();
new $controler($request->getAction());
