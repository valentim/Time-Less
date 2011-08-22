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
 $aplication = 'apl';
 $core = 'core';
 $modules = 'mod';
 
 /*
  * Set Include Path
  */
 $path = array(
 	$aplication,
 	$core,
 	$modules,
 	get_include_path()	
 );
 
 set_include_path(implode(PATH_SEPARATOR, $path));
 
/*
 * Configura autoloader
 */ 
spl_autoload_extensions('.class.php');
spl_autoload_register();
 
 /*
  * Define a url
  */
BaseUrl::getInstance("/");

 