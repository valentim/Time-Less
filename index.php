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

$request = new Request("/timeless/");
$controler = $request->getController();
echo new $controler($request->getAction());
