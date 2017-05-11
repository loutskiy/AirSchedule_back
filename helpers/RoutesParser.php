<?php
	class RoutesParser
	{
		public $url;
		
		public $page;
		
		public $date;
		
		public $airport_from;
		
		public $airport_to;
		
		private $isWrite;
		
		public $routeId;
				
		public function RoutesParser($airport_from, $airport_to, $date)
		{
			$this->airport_from = $airport_from;
			$this->airport_to = $airport_to;
			$this->isWrite = false;
			$this->page = 1;
			$this->date = $date;
			$this->url = "https://api.rasp.yandex.net/v1.0/search/?apikey=" . kAPIKEYYANDEXRASP
			. "&format=json&from=" . $this->airport_from . "&to=" . $this->airport_to . "&lang=ru&system=iata&date=" . $this->date;
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
			$threads = $array->threads;
			foreach ($threads as $thread)
			{
				$this->writeThread ($thread);
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
			$airport_id_from = Airports::getAirportIdByIATA($this->airport_from);
			$airport_id_to = Airports::getAirportIdByIATA($this->airport_to);
			$data = array(
				"id_from_airport" => isset($airport_id_from) ? $airport_id_from : 0,
				"id_to_airport" => isset($airport_id_to) ? $airport_id_to : 0,
				"date" => $this->date
			);
			$sql = "INSERT INTO `routes` SET ?u";
			$db->query($sql, $data);
			$this->routeId = $db->insertId();
			$this->isWrite = true;
		}
		
		protected function writeThread ($thread)
		{
			global $db;
			$Thread = $thread->thread;
			$threadId = ScheduleParser::writeThread ($Thread);
			$data = array(
				"route_id" => $this->routeId,
				"thread_id" => $threadId,
				"arrival" => $thread->arrival,
				"duration" => $thread->duration,
				"departure" => $thread->departure,
				"arrival_terminal" => $thread->arrival_terminal,
				"arrival_platform" => $thread->arrival_platform,
				"departure_terminal" => $thread->departure_terminal,
				"departure_platform" => $thread->departure_platform,
				"stops" => $thread->stops
			);
			$sql = "INSERT INTO `route_threads` SET ?u";
			$db->query ($sql, $data);
		}
	}