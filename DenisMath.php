<body>
  <form method="post" action="#"> 
<!-- 	  action="#" - означает, что php код на этой же странице -->
      Первое число :  <input type="text" name="num1" /><br />
      Второе число: <input type="text" name="num2" /><br />
      Действие: <br />
      <select name="boy">
          <option value="Addition">сложение</option>
          <option value="subtraction">вычетание</option>
          <option value="multiplication">умножение</option>
          <option value="division">деление</option>
      </select><br />
      <input type="submit" name="submit" value="Посчитать" />
<!--       добавим name="submit", чтобы вызывать php код только когда нажата кнопка, то есть не будет на экране выводиться введите числа -->
  </form>
  <?php
   class calc
      {
	    private $x;
	    private $y;
        private $Addition;
        private $subtraction;
        private $multiplication;
        private $division;
        
        /**
	    * Конструктор
	    **/
        function calc ($x, $y)
        {
	        $this->x = $x;
	        $this->y = $y;
        }

        public function Addition()
        {
          $this->Addition = $this->x+$this->y;
          return $this->Addition;
        }
        public function subtraction ()
        {
          $this->subtraction = $this->x-$this->y;
          return $this->subtraction;
        }
        public function multiplication ()
        {
          $this->multiplication = $this->x*$this->y;
          return $this->multiplication;
        }
        public function division ()
        {
          $this->division = $this->x/$this->y;
          return $this->division;
        }
      }
      //Великая китайсская стена
	  if ($_POST["submit"]) { // проверка на то, что кнопка посчитать была нажата
	      $x = (float)$_POST['num1']; ;
	      $y = (float)$_POST['num2']; ;
	      $obj = new calc($x,$y);
	      $action = $_POST['boy'];
	      switch ($action) {
	        case "Addition":
	          echo $obj->Addition();
	          break;
	        case "subtraction":
	          echo $obj->subtraction();
	          break;
	        case "multiplication":
	          echo $obj->multiplication();
	          break;
	        case "division":
	          echo $obj->division();
	          break;
	        default:
	          echo "введите числа";
	          break;
	      }
      }
  ?>
</body>
