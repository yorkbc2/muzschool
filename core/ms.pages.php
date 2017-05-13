<?php 

	require "ms.php";

	class MS_Page_Controller extends MS {

		public $categories = array();

		function __construct() {

			$this->connect();

			$this->categories = $this->get_categories();

		}

		function __destruct() {

			$this->close();

		}

		public function get_categories() {

			$result = $this->query("SELECT * FROM `pagecategories`");

			$result = $this->fetch($result);

			return $result;

		}

		public function add_category($info) {

			$is_able = true;

			for($i = 0; $i < sizeof($this->categories) ; $i++) {

				if($info['link'] == $this->categories[$i]['link']) {

					$is_able = false;
					break;

				}

			}

			if($is_able == true) {

				$result = $this->create_category($info);

				echo $result;

			}
			else {
				echo "Помилка в створені категорії. Змініть посилання.";
			}

		}

		public function create_category($info) {

			$name = $info['name'];
			$link = $info['link'];

			$query = $this->query("INSERT INTO `pagecategories` (id, name, link) VALUES (NULL, '$name', '$link')");

			echo $query;

		}

	}

	$ms_pages = new MS_Page_Controller();

?>