<meta charset="utf8">
<body>
<?php
	/**
	* @Class: Notification
	**/
	class Notification
	{
		function foo1 () {
			echo "Это функция класса Notification<br>";
		}
	}
  class NotificationAPNS extends Notification
	{
		function foo2 () {
			echo "Это функция из класса NotificationAPNS<br>";
			Notification::foo1 ();
		}
	}
	Notification::foo1 ();
  echo "Сверху доступ к элементу первого класса нтификэшн<br>";
	$objectClassTwo = new NotificationAPNS;
	$objectClassTwo->foo2 ();
?> </body>
