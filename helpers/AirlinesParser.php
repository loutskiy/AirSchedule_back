<?php	
	/**
	* AirlinesParser class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class AirlinesParser
	{
		public $url;
		
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
			$array = $array["airlines"];
			foreach ($array as $value)
			{
				$sql = "INSERT INTO `airlines` SET ?u";
				$db->query($sql, $value);
			}
		}
	}