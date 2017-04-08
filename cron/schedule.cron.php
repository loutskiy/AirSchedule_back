<?php
	/**
	 * This script must be running every day for all airports schedule parsing
	 */
	 
	 require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	 
	 $sql = "SELECT `iata` FROM `airports` WHERE `iata` != '' AND `active` = 1";
	 $response = $db->getAll($sql);
	 
	 $Schedule = new Schedule;
	 foreach ($response as $airport)
	 {
		$Schedule->date = date("Y-m-d");
		$Schedule->airport = $airport["iata"];
		$Schedule->event = "arrival";
		$response = $Schedule->getSchedule();
		$Schedule->event = "departure";
		$response = $Schedule->getSchedule();
	 }
	 
	 print_r("Schedule.Cron -> Success.");