<?php
	class Url
	{
		public static function generateQueryStringFromArray ($array)
		{
			foreach ($array as $key => $value)
			{
				$array[$key] = $key . "=" . $value;
			}
			$string = implode("&", $array);
			Url::openLink ($string);
		}
		
		public static function openLink ($url)
		{
			header("Location: http://airschedule.ru/web-site/index.php?" . $url );
		}
	}