<?php
	class Airlines
	{
		public static function getAirlinesIdByCode ($iata, $icao)
		{
			global $db;
			$airport_id = $db->getOne("SELECT id FROM `airlines` WHERE `iata` = ?s OR `icao` = ?s", $iata, $icao);
			return $airport_id;
		}
		
		public static function updateImageForAirlines ($id, $img)
		{
			global $db;
			$db->query ("UPDATE `airlines` SET `img` = ?s WHERE `id` = ?i", $img, $id);
		}
		
		public static function getAirlineLogoById ($airlineId)
		{
			global $db;
		}
		
		public static function getAirlineColorById ($airlineId)
		{
			global $db;
		}
	}