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
