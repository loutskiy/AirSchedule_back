<?php
	require_once dirname(__DIR__) . '/autoloader.php';
	header('Content-Type: application/json');
	
	$token = $_POST["token"];
	$airport_from = $_POST["airport_from"];
	$airport_to = $_POST["airport_to"];
	$date = $_POST["date"];
		
	if (!empty($token) /* && !empty($count) && !empty($offset) */ && !empty($airport_from) && !empty($airport_to) && !empty($date))
	{
		$Routes = new Routes ($date, $airport_from, $airport_to);
		$response = $Routes->getRoutes();
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