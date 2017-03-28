<meta charset="utf-8">
<?php
	/**
	* @Class: Notification
	**/
	class Notification
	{
		public $var; //переменная

		function getFunction ()
		{
			echo "Hello world. I'm mother fucking function in class.";
		}
	}

	$object = new Notification; // Создаем объект класса Notification

	$object->getFunction(); //Запустит функцию getFunction из класса Notification
	$object->var = "лолкек";
	echo $object->var;
