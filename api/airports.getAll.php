<?php
	/**
	* Airports get
	* This is Only for test. Not for production!
	**/
	
	require_once dirname(__DIR__) . '/autoloader.php';
	header('Content-Type: application/json');
	
	$token = $_GET["token"];
	$count = $_GET["count"];
	$offset = $_GET["offset"];
	
	$response = $db->getAll("SELECT * FROM `airports` WHERE `active` = 1 AND `iata` != '' LIMIT ?i, ?i", $offset, $count);
	$data = array(
		"status" => "success",
		"count" => count($response),
		"offset" => $offset,
		"response" => $response
	);
	echo (json_encode($data));