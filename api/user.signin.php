<?php
	require_once '/home/admin/web/airschedule.ru/public_html/autoloader.php';
	header('Content-Type: application/json');
	/**
	* User SignIn API
	* @Developer: Mikhail Lutsky
	* @Date: 28 March 2017
	**/
	
	$login = $_POST["login"];
	$password = $_POST["password"];
	
	if (!empty($login) && !empty($password))
	{
		$user = new User;
		$login = $user->initWithSignIn($login, $password);
		if ($login)
		{
			$data = array(
				"status" => "success",
				"response" => array(
					"id" => $user->id,
					"token" => $login,
					"login" => $user->login
				)
			);
			print_r(json_encode($data));
		} else
		{
			$data = $Error->getErrorByCode($user->error);
			print_r(json_encode($data));
		}
	} else
	{
		$data = $Error->getErrorByCode(6);
		print_r(json_encode($data));
	}
		