<?php
	class LocationParser
	{		
		private $countryId;
		
		private $name;
		
		private $code;
		
		private $db;
		
		public function LocationParser ()
		{
			global $db;
			$this->db = &$db;
		}
		
		public function startParsing ()
		{
			$countries = $this->getAllCountriesFromAirports ();
			foreach ($countries as $country)
			{
				$this->name = $country["name"];
				$this->code = $country["code"];
				$check = $this->checkCountryExistInDB ();
				if (!$check)
				{
					$this->insertCountryInDB ();
				}
			}
			
			$cities = $this->getAllCitiesFromAirports ();
			foreach ($cities as $city)
			{
				$this->name = $city["name"];
				$this->code = $city["code"];
				$check = $this->checkCityExistInDB ();
				if (!$check)
				{
					$this->getCountryIdByCode ($city["countryCode"]);
					$this->insertCityInDB ();
				}

			}
		}
		
		private function getAllCountriesFromAirports ()
		{
			$sql = "SELECT DISTINCT `countryCode` AS code, `countryName` AS name FROM `airports` WHERE `countryName` IS NOT NULL ORDER BY `countryName` ASC";
			$response = $this->db->getAll ($sql);
			return $response;
		}
		
		private function getAllCitiesFromAirports ()
		{
			$sql = "SELECT DISTINCT `cityCode` AS code, `city` AS name, `countryCode` AS countryCode FROM `airports` WHERE `city` IS NOT NULL ORDER BY `city` ASC";
			$response = $this->db->getAll ($sql);
			return $response;
		}
		
		private function checkCityExistInDB ()
		{
			$sql = "SELECT `id` FROM `cities` WHERE `name` = ?s AND `code` = ?s";
			$response = $this->db->getOne ($sql, $this->name, $this->code);
			return $response;
		}
		
		private function checkCountryExistInDB ()
		{
			$sql = "SELECT `id` FROM `countries` WHERE `name` = ?s AND `code` = ?s";
			$response = $this->db->getOne ($sql, $this->name, $this->code);
			return $response;
		}
		
		private function insertCountryInDB ()
		{
			$data = array(
				"name" => $this->name,
				"code" => $this->code
			);
			$sql = "INSERT INTO `countries` SET ?u";
			$this->db->query ($sql, $data);
		}
		
		private function insertCityInDB ()
		{
			$data = array(
				"name" => $this->name,
				"code" => $this->code,
				"country_id" => $this->countryId
			);
			$sql = "INSERT INTO `cities` SET ?u";
			$this->db->query ($sql, $data);
		}
		
		private function getCountryIdByCode ( $code )
		{
			$sql = "SELECT `id` FROM `countries` WHERE `code` = ?s";
			$response = $this->db->getOne ($sql, $code);
			$this->countryId = $response;
		}
	}