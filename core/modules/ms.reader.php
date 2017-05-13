<?php 

	require "ms.hash.php";

	class MS_Reader extends MS_Hash {

		public function open_file($path, $json = false) {

			if(file_exists($path)) {

				$file = fopen($path, 'r+');

				$reader = fread($file, filesize($path));

				if($json == true) {
					return json_decode($reader, true);
				}
				else {
					return $reader;
				}

			}
			else {
				echo "Такого файла не існує : ".$path;
			}

		}

	}

?>