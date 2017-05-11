<?php
	class Cities
	{
		public static function getAllCities ()
		{
			global $db;
			$sql = "SELECT * FROM `cities`";
			$response = $db->getAll ($sql);
			return $response;
		}
	}