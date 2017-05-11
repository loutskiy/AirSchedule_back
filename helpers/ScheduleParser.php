<?php	
	/**
	* ScheduleParser class
	* @Developer: Mikhail Lutsky
	* @Date: 5 April 2017
	**/
	
	class ScheduleParser
	{
		public $url;
		
		public $page;
		
		public $airport;
		
		public $event;
		
		public $date;
		
		public $asId;
				
		private $isWrite;
		
		function ScheduleParser($airport, $event, $date)
		{
			$this->page = 1;
			$this->airport = $airport;
			$this->event = $event;
			$this->date = $date;
			$this->isWrite = false;
			$this->url = "https://api.rasp.yandex.net/v1.0/schedule/?apikey=" . kAPIKEYYANDEXRASP 
			. "&format=json&station=" . $this->airport 
			. "&lang=ru&transport_types=plane&system=iata&date=" . $this->date 
			. "&event=" . $this->event;
		}
		
		public function startParsing ()
		{
			$url = $this->url . "&page=" . $this->page;
			$data = cURL::openUrl($url);
			$this->writeToDataBase ($data);
		}
		
		protected function writeToDataBase ($data)
		{
			$array = json_decode($data);
			if (!$this->isWrite)
				$this->writeAirportSchedule();
			$schedules = $array->schedule;
			foreach ($schedules as $schedule)
			{
				$this->writeSchedule ($schedule);
			}
			if ($array->pagination->has_next)
			{
				$this->page++;
				$this->startParsing ();
			}
		}
		
		protected function writeAirportSchedule ()
		{
			global $db;
			$airport_id = Airports::getAirportIdByIATA($this->airport);
			$data = array(
				"airport_id" => $airport_id,
				"date" => $this->date,
				"event" => $this->event
			);
			$sql = "INSERT INTO `airport_schedule` SET ?u";
			$db->query($sql, $data);
			$this->asId = $db->insertId();
			$this->isWrite = true;
		}
		
		public function writeThread ($thread, $event = null)
		{
			global $db;
			$airlinesId = Airlines::getAirlinesIdByCode($thread->carrier->codes->iata,$thread->carrier->codes->icao);
			$airlinesId = empty($airlinesId) ? 0 : $airlinesId;
			$title = explode(" — ", $thread->title);
			$shortTitle = explode(" — ", $thread->short_title);
			if ($event == "arrival")
			{
				$title = $title[0];
				$shortTitle = $shortTitle[0];
			} else
			{
				$title = $title[1];
				$shortTitle = $shortTitle[1];
			}
			$data = array(
				"api_platform" => "Yandex.Raspisanie",
				"airlines_id" => $airlinesId,
				"transport_type" => $thread->transport_type,
				"uid" => $thread->uid,
				"title" => $title,
				"vehicle" => $thread->vehicle,
				"number" => $thread->number,
				"short_title" => $shortTitle
			);
			$sql = "INSERT INTO `threads` SET ?u";
			$db->query ($sql, $data);
			return $db->insertId();
		}
		
		protected function writeSchedule ($schedule)
		{
			global $db;
			$thread = $schedule->thread;
			$threadId = $this->writeThread ($thread, $this->event);
			$data = array(
				"as_id" => $this->asId,
				"thread_id" => $threadId,
				"except_days" => $schedule->except_days,
				"arrival" => $schedule->arrival,
				"days" => $schedule->days,
				"departure" => $schedule->departure,
				"terminal" => $schedule->terminal,
				"is_fuzzy" => $schedule->is_fuzzy
			);
			$sql = "INSERT INTO `schedules` SET ?u";
			$db->query ($sql, $data);
		}
	}