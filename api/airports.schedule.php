<?php
	/**
	* Airports get
	* This is Only for test. Not for production!
	**/
	
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
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
		print_r(json_encode($data));
	} else
	{
		$data = $Error->getErrorByCode(6);
		print_r(json_encode($data));
	}