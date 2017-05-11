<?php
	
	class Statistics
	{
		
	
		
		public function insertStatistic ()
		{
			global $db;
			$data = array(
				
				"ip" => IP::receiveIP(),
				"user_agent" => $this->receiveUserAgent (),
				"date" => date("Y-m-d H:i:s"),
				// "location" => $this->recieveLocation (),
				"url" => $this->receiveRequest ()
			);
			
			$db->query ("INSERT INTO `statistics` SET ?u", $data);
		}
		
		public function receiveUserAgent ()
		{
			global $_SERVER;
			return $_SERVER["HTTP_USER_AGENT"];
		}
		
		public function receiveRequest ()
		{
			global $_SERVER;
			global $_POST;
			global $_GET;
			
			$data = array(
				"URI" => $_SERVER["REQUEST_URI"],
				"QUERY" => $_SERVER["QUERY_STRING"],
				"REQUEST_METHOD" => $_SERVER["REQUEST_METHOD"],
				"POST_QUERY" => $_POST
			);
			return json_encode($data);
		}
	}