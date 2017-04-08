<?php
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	/** BetaTesters class
	*
	**/

	class BetaTesters
	{
		private $id;

		public $name;

		public $email;

		public $date;

		public $platform;

		private $approve;

		public $error;

		public $errorCodes = array(
			1 => "Ошибка. Некорректный E-mail.",
			2 => "Ошибка. Данный E-mail уже зарегистрирован."
		);

		public function initWithNameAndEmail ($name, $email, $platform)
		{
			$this->name = $name;
			$this->email = $email;
			$this->platform = $platform;
			$checkEmail = self::checkEmailForCorrect ();
			if ($checkEmail)
			{
				$checkEmailForExist = self::checkEmailForExist ();
				if ($checkEmailForExist)
				{
					//Ошибка
					$this->error = 2;
					return FALSE;
				} else
				{
					$this->date = date("Y-m-d H:i:s");
					$this->approve = 0;
					self::insertEmailInDB ();
					self::sendEmailToUser ();
					return TRUE;
				}
			} else
			{
				//Ошибка
				$this->error = 1;
				return FALSE;
			}
		}

		private function checkEmailForCorrect ()
		{
			if (filter_var($this->email, FILTER_VALIDATE_EMAIL))
			{
				return TRUE;
			} else
			{
				return FALSE;
			}
		}

		private function checkEmailForExist ()
		{
			global $db;

			$email = $db->getOne("SELECT `email` FROM `beta_testers` WHERE `email` = ?s", $this->email);
			if ($email)
			{
				return TRUE;
			} else
			{
				return FALSE;
			}
		}

		private function insertEmailInDB ()
		{
			global $db;

			$data = array(
				"name" => $this->name,
				"email" => $this->email,
				"date" => $this->date,
				"platform"=> $this->platform,
				"approve" => $this->approve
			);

			$db->query("INSERT INTO `beta_testers` SET ?u", $data);
		}

		private function sendEmailToUser ()
		{
			global $mailSMTP;

			$headers= "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "From: Команда AirSchedule.ru <support@airschedule.ru>\r\n";
			$result =$mailSMTP->send($this->email, "Добро пожаловать в Бета-тестирование AirSchedule!", "Спасибо, что оставили заявку на бета-тестирование приложения AirSchedule. В скором времени мы отправим ссылку на скачивание.<br>
	        _________________________<br>
	        С Уважением,<br>
	        Команда AirSchedule<br>
	        https://airschedule.ru<br>
	        support@airschedule.ru", $headers);
		}
	}
