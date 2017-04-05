<?php
	class Airports
	{
		public static function getAirportIdByIATA ($iata)
		{
			global $db;
			$airport_id = $db->getOne("SELECT id FROM `airports` WHERE `iata` = ?s", $iata);
			return $airport_id;
		}
	}