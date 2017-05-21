<?php
	class Airports
	{
		public static function getAirportIdByIATA ($iata)
		{
			global $db;
			$airportId = $db->getOne("SELECT id FROM `airports` WHERE `iata` = ?s", $iata);
			return $airportId;
		}
		
		public static function addCountryId ($countryId, $airportId)
		{
			global $db;
			$sql = "UPDATE `airports` SET `country_id` = ?i WHERE `id` = ?i";
			$db->query ($sql, $countryId, $airportId);
		}
		
		public static function addCityId ($cityId, $airportId)
		{
			global $db;
			$sql = "UPDATE `airports` SET `city_id` = ?i WHERE `id` = ?i";
			$db->query ($sql, $cityId, $airportId);
		}
		
		public static function getAirportsIATAByCityId ($cityId)
		{
			global $db;
			$sql = "SELECT `iata` FROM `airports` WHERE `city_id` = ?i";
			$response = $db->getAll ($sql, $cityId);
			return $response;
		}
	}