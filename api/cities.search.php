<?php
	/**
	 * Cities search
	 **/
	
	require_once dirname(__DIR__) . '/autoloader.php';
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