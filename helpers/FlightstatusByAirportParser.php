<?php	
	/**
	* FlightstatusByAirportParser class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class FlightstatusByAirportParser
	{
		public $url;
		
		public function __construct($url)
		{
			$this->url = $url;
		}
		
		public function startParsing ()
		{
			$url = $this->url;
			$data = cURL::openUrl($url);
			return $data;
		}
		
/*
		protected function writeToDataBase ($data)
		{
			global $db;
			$array = json_decode($data, true);
			$array = $array["equipment"];
			foreach ($array as $value)
			{
				$sql = "INSERT INTO `equipment` SET ?u";
				$db->query($sql, $value);
			}
		}
*/
	}