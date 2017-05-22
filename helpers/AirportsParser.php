<?php	
	/**
	* AirportsParser class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class AirportsParser
	{
		protected $url;
				
		function __construct($url)
		{
			$this->url = $url;
		}
		
		public function startParsing ()
		{
			$url = $this->url;
			$data = cURL::openUrl($url);
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
	