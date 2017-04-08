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
				"ip" => $this->receiveIP(),
				"user_agent" => $this->receiveUserAgent (),
				"date" => date("Y-m-d H:i:s"),
				"request" => $this->receiveRequest ()
			);
			
			$db->query ("INSERT INTO `bug_tracker` SET ?u", $data);
		}
		
		private function receiveIP ()
		{
			//Just get the headers if we can or else use the SERVER global
			if ( function_exists( 'apache_request_headers' ) ) {
				$headers = apache_request_headers();
			} else {
				$headers = $_SERVER;
			}
			//Get the forwarded IP if it exists
			if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
				$the_ip = $headers['X-Forwarded-For'];
			} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
			) {
				$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
			} else {
				
				$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
			}
			return $the_ip;
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
				"URI" => $_SERVER["REMOTE_ADDR"],
				"QUERY" => $_SERVER["QUERY_STRING"],
				"REQUEST_METHOD" => $_SERVER["REQUEST_METHOD"],
				"POST_QUERY" => $_POST
			);
			return json_encode($data);
		}
	}