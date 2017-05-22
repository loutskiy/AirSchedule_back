<?php	
	/**
	* cURL class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class cURL
	{
		public static function openUrl ($url)
		{
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$data = curl_exec($ch);
			curl_close($ch);
			return $data;
		}
	}