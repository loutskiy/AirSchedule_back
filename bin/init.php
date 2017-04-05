<?php
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	/**
	* Init
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	$airportsActiveUrl = "https://api.flightstats.com/flex/airports/rest/v1/json/active?appId=".kAPPIDFS."&appKey=".kAPPKEYFS."&extendedOptions=languageCode:ru";
	$airlinesAllUrl = "https://api.flightstats.com/flex/airlines/rest/v1/json/all?appId=".kAPPIDFS."&appKey=".kAPPKEYFS;
	$equipmentAllUrl = "https://api.flightstats.com/flex/equipment/rest/v1/json/all?appId=".kAPPIDFS."&appKey=".kAPPKEYFS;
	
	$AirportsParser = new AirportsParser ($airportsActiveUrl);
	$AirportsParser->startParsing();
	
	$AirlinesParser = new AirlinesParser ($airlinesAllUrl);
	$AirlinesParser->startParsing();
	
	$EquipmentParser = new EquipmentParser ($equipmentAllUrl);
	$EquipmentParser->startParsing();
	
	print_r("\nInstall Complete\n");