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
		
		public static function searchCitiesByName ( $query )
		{
			global $db;
			$search = '%' . $query . '%';
			$sql = "SELECT ct.id, ct.name AS cityName, ct.code AS cityCode, cn.name AS countryName FROM `cities` ct LEFT JOIN `countries` cn ON (ct.country_id = cn.id) WHERE ct.name LIKE ?s OR ct.code LIKE ?s ORDER BY ct.name ASC";
			$response = $db->getAll ($sql, $search, $search);
			return $response;
		}
	}