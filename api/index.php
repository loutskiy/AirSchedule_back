<?php
	header('Content-Type: application/json');
	$array = array(
		"type" => "REST API",
		"name" => "AirSchedule",
		"version" => "1.0",
		"developer" => "Mikhail Lutsky"
	);
	echo (json_encode($array));