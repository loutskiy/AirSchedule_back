<?php
	/**
	* Firewall
	* @Developer: Mikhail Lutsky
	* @Date: 08 April 2017
	**/
	class Firewall
	{
		public static function checkForBlock ()
		{
			global $db;
			global $Error;
			$ip = IP::receiveIP ();
			
			$sql = "SELECT * FROM `blocked_ip` WHERE `ip` = ?s";
			$response = $db->getAll ($sql, $ip);
			
			foreach ($response as $blocked_ip)
			{
				$now = strtotime(date("Y-m-d H:i:s"));
				$exp = strtotime($blocked_ip["date_expired"]);
				if ($now <= $exp) {
					$data = $Error->getErrorByCode(7);
					die (json_encode($data));
				} else
				{
					$db->query ("DELETE FROM `blocked_ip` WHERE id = ?i", $blocked_ip["id"]);
				}
			}
		}
		
	}