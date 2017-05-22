<?php
	require_once dirname(__DIR__) . '/autoloader.php';
	header('Content-Type: application/json');
	
	$token = $_POST["token"];
	$city_from = $_POST["city_from"];
	$city_to = $_POST["city_to"];
	$date = $_POST["date"];
		
	if (!empty($token) /* && !empty($count) && !empty($offset) */ && !empty($city_from) && !empty($city_to) && !empty($date))
	{
		$CityRoutes = new CityRoutes ($date, $city_from, $city_to);
		$response = $CityRoutes->getRoutes();
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