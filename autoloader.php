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
	define('kAPIKEYYANDEXRASP', 'd3670b62-f4e7-473f-9250-fa92f9466561');
	define('kPASSHASH', 'lwts');
	define('HOMEDIR', __DIR__ . '/');
	define('BIN', 'bin/');
	define('MODULE', 'modules/');
	define('HELPER', 'helpers/');
	define('DATABASE', 'database/');
	define('IMAGES', 'images/');
	
	require_once 'bin/bootini.php';
	require_once HOMEDIR . BIN . 'version.php';
	require_once HOMEDIR . MODULE . 'mysql.class.php';
	require_once HOMEDIR . MODULE . 'email.class.php';
	require_once HOMEDIR . MODULE . 'user.class.php';
	require_once HOMEDIR . MODULE . 'token.class.php';
	require_once HOMEDIR . MODULE . 'betaTesters.class.php';
	require_once HOMEDIR . MODULE . 'schedule.class.php';
	require_once HOMEDIR . MODULE . 'airports.class.php';
	require_once HOMEDIR . MODULE . 'airlines.class.php';
	require_once HOMEDIR . MODULE . 'error.class.php';
	require_once HOMEDIR . MODULE . 'cURL.class.php';
	require_once HOMEDIR . MODULE . 'ip.class.php';
	require_once HOMEDIR . MODULE . 'bugTracker.class.php';
	require_once HOMEDIR . MODULE . 'firewall.class.php';
	require_once HOMEDIR . MODULE . 'statistic.class.php';
	require_once HOMEDIR . MODULE . 'apns.class.php';
	require_once HOMEDIR . MODULE . 'url.class.php';
	require_once HOMEDIR . MODULE . 'templator.class.php';
	require_once HOMEDIR . MODULE . 'translit.class.php';
	require_once HOMEDIR . MODULE . 'routes.class.php';
	require_once HOMEDIR . MODULE . 'copyrightYandex.class.php';
	require_once HOMEDIR . MODULE . 'cityRoutes.class.php';
	require_once HOMEDIR . MODULE . 'countries.class.php';
	require_once HOMEDIR . MODULE . 'cities.class.php';
	require_once HOMEDIR . HELPER . 'AirportsParser.php';
	require_once HOMEDIR . HELPER . 'AirlinesParser.php';
	require_once HOMEDIR . HELPER . 'EquipmentParser.php';
	require_once HOMEDIR . HELPER . 'ScheduleParser.php';
	require_once HOMEDIR . HELPER . 'AirlinesImageDaemon.php';
	require_once HOMEDIR . HELPER . 'RoutesParser.php';
	require_once HOMEDIR . HELPER . 'CopyrightParser.php';
	require_once HOMEDIR . HELPER . 'LocationParser.php';
	require_once HOMEDIR . HELPER . 'CCCodesParser.php';
	require_once HOMEDIR . HELPER . 'FlightstatusByAirportParser.php';
	require_once HOMEDIR . DATABASE . 'database.php';
	
	$db = new MySQL($dbConfig);
	$ASError = new ASError;
	$mailSMTP = new Email($emailConfig['email'], $emailConfig['pass'], $emailConfig['ssl'], $emailConfig['title'], $emailConfig['port']);
	$CopyrightYandex = new CopyrightYandex ();
	

	/**
	 * Insert your code down
	 */
	
	$Statistics = new Statistics;
	$Statistics->insertStatistic();
	Firewall::checkForBlock ();
	
	/**
	 * Daemons
	 */
	 
	$AirlinesImageDaemon = new AirlinesImageDaemon ( HOMEDIR . IMAGES . 'airlines' );
	$AirlinesImageDaemon->scanDirectory ();
	
/*
	$LocationParser = new LocationParser ();
	$LocationParser->startParsing ();
*/

/*
	$CCCodesParser = new CCCodesParser ();
	$CCCodesParser->startParsing ();
*/