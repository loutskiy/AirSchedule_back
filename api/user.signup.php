<?php
	require_once dirname(__DIR__) . '/autoloader.php';
	header('Content-Type: application/json');
	/**
	* User SignUp API
	* @Developer: Mikhail Lutsky
	* @Date: 28 March 2017
	**/
	
	$login = $_POST["login"];
	$password = $_POST["password"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	
	if (!empty($login) && !empty($password) && !empty($email) && !empty($phone))
	{
		$user = new User;
		$register = $user->initWithSignUp($login, $password, $email, $phone);
		if ($register)
		{
			$data = array(
				"status" => "success",
				"response" => array(
					"id" => $user->id,
					"token" => $register,
					"login" => $user->login,
					"email" => $user->email,
					"phone" => $user->phone
				)
			);
			print_r(json_encode($data));
		} else
		{
			$data = $ASError->getErrorByCode($user->error);
			print_r(json_encode($data));
		}
	} else
	{
		$data = $ASError->getErrorByCode(6);
		print_r(json_encode($data));
	}