<meta charset="utf8">
<?php
	require_once dirname(__DIR__) . '/autoloader.php';

	$name = $_POST['name'];
	$email = $_POST['email'];
	$platform = $_POST['platform'];
	$bot = $_POST['robot'];

	if (!empty($name) && !empty($email))
	{
		if ($bot == 1)
		{
			$BetaTesters = new BetaTesters;

			$add = $BetaTesters->initWithNameAndEmail ($name, $email, $platform);

			if ($add)
			{
				$response = "Поздравляем! Вы зарегистрированы на бета-тестирование!";
			}  else
			{
				$response = $BetaTesters->errorCodes[$BetaTesters->error];
			}
		} else
		{
			$response = "Ошибка. Вы робот.";
		}
	} else
	{
		$response = "Ошибка. Заполните все поля.";
	}

	$html = str_replace('%RESPONSE%', $response, getTemplate ('complete'));

	echo $html;

	function getTemplate ($name) {
		ob_start();
	    include (dirname(__FILE__) . "/" . $name . ".airs");
	    $text = ob_get_clean();
	    return $text;
	}
