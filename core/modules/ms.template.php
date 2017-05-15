<?php 

	require 'ms.reader.php';

	class MS_Template extends MS_Reader{

		public $main_color = "#00e64d";
		public $main_font = "'Roboto', sans-serif";

		public $web_info = array();

		private $path_info = __DIR__."/template/info.json";

		function __construct() {

			$this->web_info = $this->open_file($this->path_info, true);

		}

		public function set_title($new_title) {
			
			$this->edit_json('website', 'title', $new_title, $this->path_info);

		}

		public function set_description($new_desc) {

			$this->edit_json('website', 'description', $new_desc, $this->path_info);

		}

		public function set_keywords($new_keys) {

			$this->edit_json('website', 'keywords', $new_keys, $this->path_info);

		}

		public function get_title() {
			return $this->web_info['website']['title'];
		}

		public function get_description() {
			return $this->web_info['website']['description'];
		}

		public function get_keywords() {
			return $this->web_info['website']['keywords'];
		}

		public function set_general_info($what, $text) {

			switch($what) {
				case "title" :
					$this->set_title($text);
					return true;
				case "description" :
				case "desc" :
					$this->set_description($text);
					return true;
				case "keywords" :
				case "keys" :
					$this->set_keywords($text);
					return true;
				default: 
					return false;
			}

		}


		public function title() {

			echo $this->web_info['website']['title'];

		}

		public function description() {

			echo $this->web_info['website']['description'];

		}

	}

?>