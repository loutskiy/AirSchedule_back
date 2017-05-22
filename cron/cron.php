<?php
	class Cron
	{
		private $time;
		
		private $date;
		
		private $db;
		
		private $job;
		
		public function __construct ()
		{
			$this->datetime = time();
			$this->db = &$db;
		}
		
		public function startParsing ()
		{
			$cronTable = $this->getCronTable ();
		}
		
		private function getCronTable ()
		{
			$sql = "SELECT * FROM `cron` ORDER BY `id` ASC";
			$response = $this->db->getAll ($sql);
			return $reponse;
		}
		
		private function checkLastJobDate ()
		{
			
		}
		
		private function runJob ( $job )
		{
			
		}
		
		
	}