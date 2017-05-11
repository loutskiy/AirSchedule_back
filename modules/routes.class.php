<?php
	/**
	* Routes class
	* @Developer: Mikhail Lutsky
	* @Date: 26 April 2017
	**/
	class Routes
	{
		public $date;
		
		public $airport_from;
		
		public $airport_to;
		
		private $airport_id_from;
		
		private $airport_id_to;
		
		private $routeId;
		
		function Routes($date = null, $airport_from = null, $airport_to = null)
		{
			$this->date = $date;
			$this->airport_from = $airport_from;
			$this->airport_to = $airport_to;
		}
		
		public function getRoutes ()
		{
			$response = $this->checkForExistInDB();
			if (!$response)
			{
				$this->parsingDB ();
			} else
			{
				$this->routeId = $response;
			}
			$routes = $this->getRoutesFromDB();
			return $routes;
		}
		
		private function getRoutesFromDB ()
		{
			global $db;
			$sql = "SELECT * FROM route_threads s LEFT JOIN threads t ON (s.thread_id = t.id) WHERE s.route_id = ?i ORDER BY s.id ASC";
			$response = $db->getAll($sql, $this->routeId);
			return $response;
		}
		
		private function checkForExistInDB ()
		{
			global $db;
			$sql = "SELECT `id` FROM `routes` WHERE `date` = ?s AND `id_from_airport` = ?s AND `id_to_airport` = ?s";
			$this->airport_id_from = Airports::getAirportIdByIATA($this->airport_from);
			$this->airport_id_to = Airports::getAirportIdByIATA($this->airport_to);
			$response = $db->getOne($sql, $this->date, $this->airport_id_from, $this->airport_id_to);
			return $response;
		}
		
		private function parsingDB ()
		{
			$RoutesParser = new RoutesParser($this->airport_from, $this->airport_to, $this->date);
			$RoutesParser->startParsing();
			$this->routeId = $RoutesParser->routeId;
		}
	}