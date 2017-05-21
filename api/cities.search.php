<?php
	/**
	 * Cities search
	 **/
	
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	header('Content-Type: application/json');
	
	$token = $_GET["token"];
	$query = Translit::translitToEnglish ( $_GET["search"] );
	
	$response = Cities::searchCitiesByName ($query);
	$data = array(
		"status" => "success",
		"count" => count($response),
		"response" => $response
	);
	echo (json_encode($data));