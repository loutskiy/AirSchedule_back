<?php
	class CopyrightParser
	{
		private $url;
		
		public function CopyrightParser()
		{
			$this->url = "https://api.rasp.yandex.net/v1.0/copyright/?apikey=" . kAPIKEYYANDEXRASP . "&format=json";
		}
		
		public function startParsing ()
		{
			$url = $this->url;
			$data = cURL::openUrl($url);
			$this->writeToDataBase ($data);
		}
		
		protected function writeToDataBase ($data)
		{
			global $db;
			$array = json_decode($data);
			$copyright = $array->copyright;
			$md5 = md5($data);
			$checkForExistInDB = $this->checkForExistInDB ($md5);
			if (!$checkForExistInDB)
			{
				$dictionary = array(
					"logo_vm" => $copyright->logo_vm,
					"logo_hd" => $copyright->logo_hd,
					"logo_vy" => $copyright->logo_vy,
					"logo_vd" => $copyright->logo_vd,
					"logo_hm" => $copyright->logo_hm,
					"logo_hy" => $copyright->logo_hy,
					"url" => $copyright->url,
					"text" => $copyright->text,
					"md5" => $md5
				);
				$sql = "INSERT INTO `copyright_yandex` SET ?u";
				$db->query ($sql, $dictionary);
			}
		}
		
		protected function checkForExistInDB ($md5)
		{
			global $db;
			$sql = "SELECT `id` FROM `copyright_yandex` WHERE `md5` = ?s";
			$response = $db->getOne($sql, $md5);
			return $response;
		}
	}