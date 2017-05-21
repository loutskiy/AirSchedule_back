<?php
	class CityRoutes extends Routes
	{
		private $cityFromId;
		
		private $cityToId;
		
		private $routeIds;
		
		private $db;
		
		function CityRoutes($date, $cityFromId, $cityToId)
		{
			global $db;
			$this->date = $date;
			$this->cityFromId = $cityFromId;
			$this->cityToId = $cityToId;
			$this->db = &$db;
		}
		
		public function getRoutes ()
		{
			$airportsFrom = Airports::getAirportsIATAByCityId ($this->cityFromId);
			$airportsTo = Airports::getAirportsIATAByCityId ($this->cityToId);
			foreach ($airportsFrom as $airportFrom)
			{
				foreach ($airportsTo as $airportTo)
				{
					$this->airport_from = $airportFrom['iata'];
					$this->airport_to = $airportTo['iata'];
					$response = $this->checkForExistInDB();
					if (!$response)
					{
						$this->parsingDB ();
					} else
					{
						$this->routeId = $response;
					}
					$this->routeIds [] = $this->routeId;
				}
			}
			$routes = $this->getRoutesFromDB();
			return $routes;
		}
		
		protected function getRoutesFromDB ()
		{
			$sql = "SELECT * FROM route_threads s LEFT JOIN threads t ON (s.thread_id = t.id) WHERE s.route_id IN (?a) ORDER BY s.id ASC";
			$response = $this->db->getAll($sql, $this->routeIds);
			return $response;
		} 
	}