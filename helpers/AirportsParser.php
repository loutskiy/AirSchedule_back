<?php
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	
	/**
	* AirportsParser class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class AirportsParser
	{
		protected $url;
				
		function AirportsParser($url)
		{
			$this->url = $url;
		}
		
		public function startParsing ()
		{
			$url = $this->url;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			curl_close($ch);
			self::writeToDataBase ($data);
		}
		
		protected function writeToDataBase ($data)
		{
			global $db;
			$array = json_decode($data, true);
			$array = $array["airports"];
			foreach ($array as $value)
			{
				$sql = "INSERT INTO `airports` SET ?u";
				$db->query($sql, $value);
			}
		}
	}
	