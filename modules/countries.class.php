<?php
	class Countries
	{
		public static function getAllCountries ()
		{
			global $db;
			$sql = "SELECT * FROM `countries`";
			$response = $db->getAll ($sql);
			return $response;
		}
	}