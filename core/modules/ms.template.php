<?php 

	require 'ms.reader.php';

	class MS_Template extends MS_Reader{

		public $main_color = "#00e64d";
		public $main_font = "'Roboto', sans-serif";

		public $web_info = array();

		function __construct() {

			$this->web_info = $this->open_file(__DIR__."/template/info.json", true);

		}

		public function get_title() {

			echo $this->web_info['title'];

		}

		public function get_description() {

			echo $this->web_info['description'];

		}

	}

?>