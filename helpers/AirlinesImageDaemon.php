<?php
	class AirlinesImageDaemon
	{
		private $dir;
		
		public function __construct ( $dir )
		{
			$this->dir = $dir;
		}
		
		public function scanDirectory ( )
		{
			$files = scandir( $this->dir );
			unset( $files[0] );
			unset( $files[1] );
			foreach ( $files as $value ) {
				$name = explode(".", $value);
				$data = explode("-", $name[0]);
				$prefix = $data[0];
				$code = $data[1];
				$airline_id = Airlines::getAirlinesIdByCode($prefix, $prefix);
				Airlines::updateImageForAirlines($airline_id, $value);
			}
		}
	}