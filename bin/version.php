<?php
	/**
	* Component for detect PHP version
	* @Developer: Mikhail Lutsky
	* @Date: 28 March 2017
	**/
	
	if (!defined('PHP_VERSION_ID')) {
	    $version = explode('.', PHP_VERSION);
	
	    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
	}
	
	if (PHP_VERSION_ID < 50400) {
		die ("Error. Update your PHP version to 5.4.0.");
	}
