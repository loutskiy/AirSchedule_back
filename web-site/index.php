<?php
	require_once dirname(__DIR__) . '/autoloader.php';
	$Schedule = new Schedule (date("Y-m-d"), "SVO", "departure");
	$response = $Schedule->getSchedule();
	$Templator = new Templator;
	$Templator->init ('schedule');
	$Templator->showPage ();
	?>