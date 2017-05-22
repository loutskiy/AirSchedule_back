<?php
	/**
	* User class
	* @Developer: Mikhail Lutsky
	* @Date: 27 March 2017
	**/
	
	class User
	{
		public $id;
		
		public $permissions;
		
		public $login;
		
		private $password;
		
		public $email;
		
		public $phone;
		
		public $dateOfRegistration;
		
		public $active;
		
		public $error;
		
		public function initWithUserId ($id)
		{
			$this->id = $id;
			self::getUserById ();
		}
		
		public function initWithSignIn ($login, $password)
		{
			$this->login = $login;
			$this->password = self::generatePasswordHash ($password);
			$userExist = self::searchUserForExist ($this->login);
			if ($userExist)
			{
				$userActive = self::checkUserForActivated ();
				if ($userActive)
				{
					$checkPassword = self::checkUserPassword ();
					if ($checkPassword)
					{
						$token = new Token;
						return $token->newTokenForUserId($this->id);
					}
					else
					{
						$this->error = 3;
						return FALSE;
					}
				} else
				{
					$this->error = 2;
					return FALSE;
				}
			} else
			{
				$this->error = 1;
				return FALSE;
			}
		}
		
		public function initWithSignUp ($login, $password, $email, $phone)
		{
			global $db;
			$this->login = $login;
			$this->password = self::generatePasswordHash ($password);
			$this->email = $email;
			$this->phone = $phone;
			$userExist = self::searchUserForExist ($this->login, $this->email, $this->phone);
			if ($userExist)
			{
				$this->error = 4;
				return FALSE;
			} else
			{
				$this->permissions = 1;
				$this->dateOfRegistration = date("Y-m-d H:i:s");
				$this->active = 1;
				$data = array(
					"permissions" => $this->permissions,
					"login" => $this->login,
					"password" => $this->password,
					"email" => $this->email,
					"phone" => $this->phone,
					"dateOfRegistration" => $this->dateOfRegistration,
					"active" => $this->active
				);
				$db->query("INSERT INTO users SET ?u", $data);
				$this->id = $db->insertId();
				$token = new Token;
				return $token->newTokenForUserId($this->id);
			}
		}
		
		public function initWithRestorePassword ($login)
		{
			$this->login = $login;
		}
		
		private function searchUserForExist ()
		{
			global $db;
			
			$args = func_num_args();
			$dataArgs = func_get_args();
			for ($i = 0; $i < $args; $i++)
			{
				$response = $db->getOne("SELECT id FROM users WHERE login = ?s OR email = ?s OR phone = ?s", $dataArgs[$i], $dataArgs[$i], $dataArgs[$i]);
				if ($response)
				{
					$this->id = $response;
					return TRUE;
				}
			}
			return FALSE;
		}
		
		private function checkUserForActivated ()
		{
			global $db;
			
			$response = $db->getOne("SELECT id FROM users WHERE id = ?i AND active = 1", $this->id);
			if ($response)
				return TRUE;
			else
				return FALSE;
		}
		
		private function checkUserPassword ()
		{
			global $db;
			
			$response = $db->getOne("SELECT password FROM users WHERE id = ?i", $this->id);
			if ($response == $this->password)
				return TRUE;
			else
				return FALSE; 
		}
		
		private function getUserById ()
		{
			global $db;
			$data = $db->getAll("SELECT * FROM `users` WHERE id = ?i", $this->id);
			$data = $data[0];
			
			$this->permissions = $data["permissions"];
			$this->login = $data["login"];
			$this->password = $data["password"];
			$this->email = $data["email"];
			$this->phone = $data["phone"];
			$this->dateOfRegistration = $data["dateOfRegistration"];
			$this->active = $data["active"];
		}
		
		private function generatePasswordHash ($password)
		{
			$passwordHash = md5(md5($password)) . kPASSHASH;
			return $passwordHash;
		}
	}