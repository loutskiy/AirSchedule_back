<?php
	/** BugTracker class for insert bug statistic in database
	 * @Developer: Mikhail Lutsky
	 * @Date: 8 April 2017
	 */
	class BugTracker
	{
		private $errorCode;
		
		private $errorDescription;
		
		function BugTracker ($errorCode, $errorDescription)
		{
			$this->errorCode = $errorCode;
			$this->errorDescription = $errorDescription;
		}
		
		public function insertStatistic ()
		{
			global $db;
			$data = array(
				"error_code" => $this->errorCode,
				"error_description" => $this->errorDescription,
				"ip" => IP::receiveIP(),
				"user_agent" => $this->receiveUserAgent (),
				"date" => date("Y-m-d H:i:s"),
				"request" => $this->receiveRequest ()
			);
			
			$db->query ("INSERT INTO `bug_tracker` SET ?u", $data);
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