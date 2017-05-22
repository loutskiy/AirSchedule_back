<?php
	/**
	* Token class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class Token
	{
		public $id;
		
		public $token;
		
		public $userId;
		
		public $dateOfRegistration;
		
		public function newTokenForUserId ($userId)
		{
			global $db;
			
			$this->userId = $userId;
			$this->dateOfRegistration = date("Y-m-d H:i:s");
			
			self::generateToken ();
			
			$data = array(
				"value" => $this->token,
				"user_id" => $this->userId,
				"dateOfRegistration" => $this->dateOfRegistration
			);
			$db->query("INSERT INTO `tokens` SET ?u", $data);
			
			return $this->token;
		}
		
		public static function checkTokenForUserId ($userId, $token)
		{
			global $db;
			
			$response = $db->getOne("SELECT id FROM tokens WHERE user_id = ?i AND value = ?s", $userId, $token);
			if ($response)
				return TRUE;
			else
				return FALSE;
		}
		
		private function generateToken ()
		{
			$token = sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
		        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
		
		        mt_rand( 0, 0xffff ),
		
		        mt_rand( 0, 0x0fff ) | 0x4000,
		
		        mt_rand( 0, 0x3fff ) | 0x8000,
		
		        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
		    );
		    $this->token = $token;
		}
	}