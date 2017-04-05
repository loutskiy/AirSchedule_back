<?php
	/**
	* Airports get
	* This is Only for test. Not for production!
	**/
	
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	header('Content-Type: application/json');
	
	$token = $_GET["token"];
	$count = $_GET["count"];
	$offset = $_GET["offset"];
	
	$response = $db->getAll("SELECT * FROM `airports` LIMIT ?i, ?i", $offset, $count);
	$data = array(
		"status" => "success",
		"count" => count($response),
		"offset" => $offset,
		"response" => $response
	);
	echo (json_encode($data));