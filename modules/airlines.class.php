<?php
	class Airlines
	{
		public static function getAirlinesIdByCode ($iata, $icao)
		{
			global $db;
			$airport_id = $db->getOne("SELECT id FROM `airlines` WHERE `iata` = ?s OR `icao` = ?s", $iata, $icao);
			return $airport_id;
		}
	}