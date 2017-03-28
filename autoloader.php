<?php
	/**
	* Autoloader
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	session_start();
	
	$isDev = true;
	
	if ($isDev)
	{
		ini_set('error_reporting', E_ALL);
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
	}
	
	define('kAPPIDFS', '55295fba');
	define('kAPPKEYFS', '0d48bd9e704b06c900a6b46fd5e86cd0');
	define('kPASSHASH', 'lwts');
	define('HOMEDIR', '/home/admin/web/airschedule.ru/public_html/');
	define('BIN', 'bin/');
	define('MODULE', 'modules/');
	define('HELPER', 'helpers/');
	
	require_once '/configs/bootiniAS.php';
	require_once HOMEDIR . BIN . 'version.php';
	require_once HOMEDIR . MODULE . 'mysql.class.php';
	require_once HOMEDIR . MODULE . 'email.class.php';
	require_once HOMEDIR . MODULE . 'user.class.php';
	require_once HOMEDIR . MODULE . 'token.class.php';
	require_once HOMEDIR . MODULE . 'betaTesters.class.php';
	require_once HOMEDIR . HELPER . 'AirportsParser.php';
	require_once HOMEDIR . HELPER . 'AirlinesParser.php';
		
	$db = new MySQL($dbConfig);
	
	$mailSMTP = new Email($emailConfig['email'], $emailConfig['pass'], $emailConfig['ssl'], $emailConfig['title'], $emailConfig['port']);
