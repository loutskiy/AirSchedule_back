<?php	
	class Templator
	{
		private $page;
		
		private $data;
		
		private $dir;
		
		public function init ($page, $data = null)
		{
			global $db;
			$this->dir = $db->getOne ("SELECT value FROM `configs` WHERE field = 'site_dir' ORDER BY id DESC LIMIT 1");
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
		    include (dirname(__FILE__) . "/../" . $this->dir . "/" . $templateName . "/" . $name . ".tpl");
		    $text = ob_get_clean();
		    return $text;
		}
	}