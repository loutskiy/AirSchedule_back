<?php
	/**
	* Error class
	* @Developer: Mikhail Lutsky
	* @Date: 28 March 2017
	**/
	
	class Error
	{
		private $errorCodes = array(
			0 => "NONE",
			1 => "USER NOT EXIST",
			2 => "USER NOT ACTIVE",
			3 => "INCORRECT PASSWORD",
			4 => "USER ALREADY EXIST",
			5 => "INVALID TOKEN"
		);
		
		public function getErrorDescription ($errorCode)
		{
			return $this->errorCodes[$errorCode];
		}
	}