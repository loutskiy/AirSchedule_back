<?php
	class FlightStatuses
	{
		private $requestedAirport;
		
		/**
		* @param: arr or dep
		**/
		private $flightsType;
		
		private $requestedYear;
		
		private $requestedMonth;
		
		private $requestedDay;
		
		/**
		* @param: offset time of requested day
		**/
		private $requestedHour;
		
		/**
		* @param: count of Hours for List
		**/
		private $requestedNumHours;
		
		private $url;
		
		public FlightStatuses($requestedAirport, $flightsType, $requestedYear, $requestedMonth, $requestedDay, $requestedHour, $requestedNumHours)
		{
			$this->requestedAirport  = $requestedAirport;
			$this->flightsType = $flightsType;
			$this->requestedYear = $requestedYear;
			$this->requestedMonth = $requestedMonth;
			$this->requestedDay = $requestedDay;
			$this->requestedHour = $requestedHour;
			$this->requestedNumHours = $requestedNumHours;
			$this->url = configureUrl ();
		}
		
		private configureUrl ()
		{
			$url = "https://api.flightstats.com/flex/flightstatus/rest/v2/json/airport/status/" . $this->requestedAirport . "/" . $this->flightsType . "/" . $this->requestedYear . "/" . $this->requestedMonth . "/" . $this->requestedDay . "/" . $this->requestedHour . "/" . $this->requestedNumHours . "?appId=" . kAPPIDFS . "&appKey=" . kAPPKEYFS . "&utc=false&numHours=" . $this->requestedNumHours;
			return $url;
		}
		
		public getSchedule ()
		{
			$CheckRequestForExistInDB = $this->checkRequestForExistInDB ();
			if ($CheckRequestForExistInDB)
			{
				
			} else
			{
				$fsbap = new FlightstatusByAirportParser ($url);
				$fsbap->startParsing();
			}
		}
		
		public checkRequestForExistInDB ()
		{
			global $db;
			$query = "SELECT id FROM airportStatuses WHERE airport = ?s AND year = ?i AND month = ?i AND day = ?i AND hourOfDay = ?i AND numHours = ?i AND flightsType = ?s";
			$result = $db->getCol ($query, $this->requestedAirport, $this->requestedYear, $this->requestedMonth, $this->requestedDay, $this->requestedHour, $this->requestedNumHours, $this->flightsType);
			return $result;
		}
		
		private getScheduleFromDB ()
		{
			global $db;
			
		}
		
		private parseData ()
		{
			$
		}
	}