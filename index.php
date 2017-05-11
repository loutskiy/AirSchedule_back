<?php
	require_once 'autoloader.php';
	$dir = $db->getOne ("SELECT value FROM `configs` WHERE field = 'site_dir' ORDER BY id DESC LIMIT 1");
	header ('Location: https://airschedule.ru/' . $dir . '/');