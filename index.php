<?php
/**
 * Time Less
 * 
 * Este arquivo contem configura›es iniciais do microframework
 * Ž o bookstrap do Time Less e est‡ em fase de testes gerais, principalmente
 * de performace.
 * 
 */

/*
 * Set comportamento dos erros
 */
 error_reporting(E_ALL);
 
 /*
  * Defini‹o dos diret—rios da aplica‹o
  */
 define('APPLICATION_PATH', realpath(dirname(__FILE__)));
 $aplication = APPLICATION_PATH.'/tl/apl';
 $core = APPLICATION_PATH.'/tl/core';
 $modules = APPLICATION_PATH.'/tl/mod';
 
 /*
  * Set Include Path
  */
 $path = array(
 	$aplication,
 	$core,
 	$modules
 );
 
 set_include_path(implode(PATH_SEPARATOR, $path));
 
 /*
  * Registrando Fun›es
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
$registry->set('url', '/');

/*
 * Define Controller e Action Iniciais
 */
$registry->set('controller', 'welcome');
$registry->set('action', 'index');

/*
 * Define Banco de dados
 */
$registry->set("mysql", new database_pdo("mysql:host=localhost;dbname=timeless", "root", "123456"));

$route = new Route("/timeless/");
$controler = $route->getController();
echo new $controler($route->getAction());
