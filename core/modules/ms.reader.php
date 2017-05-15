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

		public function remove_file($path) {

			if(file_exists($path)) {
				
				$remove = unlink($path);

				if(!$remove) {
					return false;
				}
				else {
					return true;
				}

			}
			else {
				return false;
			}

		}

		public function write($file, $content) {
			$file_opened = fopen($file, 'w+');
			$writer = fwrite($file_opened, $content);
			fclose($file_opened);
			return $writer;
		}

		public function edit_json($f_array, $s_array = false, $content, $file) {

			$before_ = $this->open_file($file, true);

			if($s_array) {
				$before_[$f_array][$s_array] = $content;
			}
			else {
				$before_[$f_array] = $content;
			}

			$writer = $this->write($file, json_encode($before_, true));

			return $writer;

		}

	}

?>