<?php
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	
	$data = cURL::openUrl('http://airschedule.ru/api/index.php');
	
	$object = json_decode($data);
	
	print_r($object->name);