<?php
	/**
	* Schedule class
	* @Developer: Mikhail Lutsky
	* @Date: 5 April 2017
	**/
	class Schedule
	{
		public $date;
		
		public $airport;
		
		public $event;
		
		private $airport_id;
		
		private $asId;
		
		function Schedule($date = null, $airport = null, $event = null)
		{
			$this->date = $date;
			$this->airport = $airport;
			$this->event = $event;
		}
		
		public function getSchedule ()
		{
			$response = $this->checkForExistInDB();
			if (!$response)
			{
				$this->parsingDB ();
			} else
			{
				$this->asId = $response;
			}
			$schedule = $this->getScheduleFromDB();
			return $schedule;
		}
		
		private function getScheduleFromDB ()
		{
			global $db;
			$sql = "SELECT * FROM schedules s LEFT JOIN threads t ON (s.thread_id = t.id) WHERE s.as_id = ?i ORDER BY s.id ASC";
			$response = $db->getAll($sql, $this->asId);
			return $response;
		}
		
		private function checkForExistInDB ()
		{
			global $db;
			$sql = "SELECT `id` FROM `airport_schedule` WHERE `date` = ?s AND `event` = ?s AND `airport_id` = ?s";
			$this->airport_id = Airports::getAirportIdByIATA($this->airport);
			$response = $db->getOne($sql, $this->date, $this->event, $this->airport_id);
			return $response;
		}
		
		private function parsingDB ()
		{
			$ScheduleParser = new ScheduleParser($this->airport, $this->event, $this->date);
			$ScheduleParser->startParsing();
			$this->asId = $ScheduleParser->asId;
		}
	}