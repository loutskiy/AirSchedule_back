<?php
	class CopyrightYandex
	{
		const LogoVm = "logo_vm";
		
		const LogoHd = "logo_hd";
		
		const LogoVy = "logo_vy";
		
		const LogoVd = "logo_vd";
		
		const LogoHm = "logo_hm";
		
		const LogoHy = "logo_hy";
		
		const Url = "url";
		
		const Text = "text";
		
		public function __construct()
		{
			$CopyrightParser = new CopyrightParser ();
			$CopyrightParser->startParsing ();
		}
		
		public function getCopyrightItem ( $item )
		{
			global $db;
			$sql = "SELECT ?n FROM `copyright_yandex` ORDER BY `id` DESC LIMIT 1";
			$response = $db->getOne ($sql, $item);
			return $response;
		}
	}