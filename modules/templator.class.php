<?php	
	class Templator
	{
		private $page;
		
		private $data;
		
		public function init ($page, $data = null)
		{
			$this->page = $page;
			$this->data = $data;
		}
		
		public function showPage () {
			echo $this->generateHeader ();
			echo $this->generatePage ();
			echo $this->generateFooter ();
		}
		
		private function generateHeader ()
		{
			$header = $this->getTemplate ("top");
			return $header;
		}
		
		private function generateFooter ()
		{
			$footer = $this->getTemplate ("bottom");
			return $footer;
		}
		
		private function generatePage ()
		{
			$page = $this->getTemplate ($this->page);
			return $page;
		}
		
		public function getTemplate ($name, $templateName = "template")
		{
			ob_start();
		    include (dirname(__FILE__) . "/../web-site/" . $templateName . "/" . $name . ".tpl");
		    $text = ob_get_clean();
		    return $text;
		}
	}