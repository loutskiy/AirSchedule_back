<?php
	/**
	* Airports get
	**/
	
	require_once dirname(__DIR__) . '/autoloader.php';
	header('Content-Type: application/json');
	
	$token = $_POST["token"];
	$airport = $_POST["airport"];
	$date = $_POST["date"];
	$event = $_POST["event"];
		
	if (!empty($token) /* && !empty($count) && !empty($offset) */ && !empty($airport) && !empty($date) && !empty($event))
	{
		$Schedule = new Schedule ($date, $airport, $event);
		$response = $Schedule->getSchedule();
		$data = array(
			"status" => "success",
			"response" => $response
		);
		$ASError->getErrorByCode(0);
		print_r(json_encode($data));
	} else
	{
		$data = $ASError->getErrorByCode(6);
		print_r(json_encode($data));
	}