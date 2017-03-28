<?php
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	
	/**
	* AirlinesParser class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class AirlinesParser
	{
		public $url;
		
		function AirlinesParser($url)
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
			$array = $array["airlines"];
			foreach ($array as $value)
			{
				$sql = "INSERT INTO `airlines` SET ?u";
				$db->query($sql, $value);
			}
		}
	}