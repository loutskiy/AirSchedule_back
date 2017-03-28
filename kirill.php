<meta charset="utf-8">
<body>
<?php
  /**
  * @Class: Notification
  **/
  class Notification
  {
    function foo1 () {
        echo "Эта функция из класса Notification<br>";
    }
  }
  class NotificationAPNS extends Notification // наследование
  {
      function foo1 () {
        echo "Это функция из класса NotificationAPNS<br>";
        Notification::foo1 (); // функция из класса Notification
      }
  }
  Notification::foo1 ();
  $objectClassTwo = new NotificationAPNS;
  $objectClassTwo->foo1 ();
  // {
  //   public $var; // переменная
  //
  //   public $backgroundColor;
  //   function Notification($color)
  //   {
  //       $this->backgroundColor = $color;
  //   }
  //   function applyBgColor() {
  //     echo "<style> body { background-color: " . $this->backgroundColor." } </style>"; // присваиваем body backgroundColor = то значение которое мы получаем при вызове Notification
  //   }
    // function getFunction ()
    // {
    //     echo "Hello world.";
    // }
    //
    // function getVar ()
    // {
    //     echo $this->var; // обращение к методам и переменным класса Notification
    // }
    //
    // function setVar ($var){
    //     $this->var = $var;
    // }
  // $arrayWithColor = array("yellow", "green","black","blue","red","gray");
  // $object = new Notification("green"); // Создаем объект класса Notification
  // // $object->setVar ("Text from main file to Notification Class"); // Обращаемся к функции setVar класса Notification
  // // $object->getVar (); // Обращаемся к функции getVar класса Notification
  // $object->applyBgColor();
/*
$object->getFunction(); //Запустит функцию getFunction из класса Notification
  $object->var = "This is my var";
  echo $object->var;
*/
?>
</body>
