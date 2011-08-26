<?php

/** 
 * @author thiagovalentim
 * 
 * 
 */
class TimeLess {
	
	public function __construct() {
	
	}
	
	public function crawlerDir($className) {
		$fileParts = explode('\\', ltrim($className, '\\'));
	    if (false !== strpos(end($fileParts), '_')) {
	        array_splice($fileParts, -1, 1, explode('_', current($fileParts)));
	    }
	    
	    return implode(DIRECTORY_SEPARATOR, $fileParts);
	}
}

?>