<?php
	class Airports
	{
		public static function getAirportIdByIATA ($iata)
		{
			global $db;
			$airportId = $db->getOne("SELECT id FROM `airports` WHERE `iata` = ?s", $iata);
			return $airportId;
		}
		
		public static function addCountryId ($airportId, $countryId)
		{
			global $db;
			$sql = "UPDATE `airports` SET `country_id` = ?i WHERE `id` = ?i";
			$db->query ($sql, $countryId, $airportId);
		}
		
		public static function addCityId ($airportId, $cityId)
		{
			global $db;
			$sql = "UPDATE `airports` SET `city_id` = ?i WHERE `id` = ?i";
			$db->query ($sql, $cityId, $airportId);
		}
	}