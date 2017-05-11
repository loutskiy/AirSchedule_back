<?php
	/**
	 * Транслит согласно ГОСТ 7.79-2000
	 * @Author: Mikhail Lutskiy
	 */
	class Translit
	{	 
		public static function getTranslitArray ()
		{
			return array (
				'а' => 'a',   'б' => 'b',   'в' => 'v',
				'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
				'и' => 'i',   'й' => 'j',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',
				'о' => 'o',   'п' => 'p',   'р' => 'r',
	            'с' => 's',   'т' => 't',   'у' => 'u',
	            'ф' => 'f',   'х' => 'x',   'ц' => 'c',
	            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shh',
	            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'\'',
	            'э' => 'e\'',   'ю' => 'yu',  'я' => 'ya',
	
	            'А' => 'A',   'Б' => 'B',   'В' => 'V',
	            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
	            'Ё' => 'Yo',   'Ж' => 'Zh',  'З' => 'Z',
	            'И' => 'I',   'Й' => 'J',   'К' => 'K',
	            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
	            'О' => 'O',   'П' => 'P',   'Р' => 'R',
	            'С' => 'S',   'Т' => 'T',   'У' => 'U',
	            'Ф' => 'F',   'Х' => 'X',   'Ц' => 'C',
	            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Shh',
	            'Ь' => '\'',  'Ы' => 'Y\'',   'Ъ' => '\'\'',
	            'Э' => 'E\'',   'Ю' => 'Yu',  'Я' => 'Ya',
	        );
        }
        
        public static function translitToEnglish ( $string )
        {
	        $result = strtr( $string, Translit::getTranslitArray() );
	        return $result;
        }
        
        public static function translitToRussia ( $string  )
        {
	        $result = strtr( $string, array_flip ( Translit::getTranslitArray() ) );
	        return $result;
        }
	}