<?php 

	require "ms.router.php";

	class MS_Page_Controller extends MS_Router {

		public $categories = array();

		function __construct() {

			$this->connect();

			$this->categories = $this->get_categories();

			$this->basepath = $this->ms_basepath;

		}

		function __destruct() {

			$this->close();

		}

		public function get_categories() {

			$result = $this->query("SELECT * FROM `pagecategories`");

			$result = $this->fetch($result);

			return $result;

		}


		public function get_pages() {

			$pages = $this->query("SELECT * FROM `pagelist`");
			$pages = $this->fetch($pages);

			return $pages;

		}

		public function echo_pages($pages, $prefix) {

			for($i = 0; $i < sizeof($pages) ; $i++) {

				echo "<li><a href='".$prefix."/".$pages[$i]['link']."'>".$pages[$i]['name']."</a></li>";

			}

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

		public function insert_page($query, $name, $link) {


			$res = $this->clone_page_secure($link);

			if($res) {
				return false;
			}
			else {
				$route = $this->add_route($link, $link);
				$this->query($query);

				return true;
			}

		}

		public function clone_page_secure($link) {

			$pages = "SELECT * FROM `pagelist` WHERE link='$link'";

			$pages = $this->query($pages);

			$pages = mysqli_fetch_array($pages);

			if(isset($pages['link'])) {
				return true;
			}

			else {

				$routes = "SELECT * FROM `routelist` WHERE url='$link'";

				$routes = $this->query($routes);

				$routes = mysqli_fetch_array($routes);

				if(isset($routes['url'])) {
					return true;
				}
				else {
					return false;
				}

			}

		}

		public function create_page($content, $link, $name) {

			$base_url = __DIR__."/views/user/";

			$filename = basename($link);

			$filename_ext = $filename.".html";

			$full_path = $base_url.$filename_ext;

			if(!file_exists($full_path)) {

				$file = fopen($full_path, "w");

				$writer = fwrite($file, $content);

				fclose($file);

				return $writer;



			}
			else {
				return "Така сторінка вже існує!";
			}

		}

		public function remove_page($id, $link) {

			$query = "DELETE FROM `pagelist` WHERE id='$id'";

			$result = $this->query($query);

			if(!$result) {
				return false;
			}

				$dos_query = "DELETE FROM `routelist` WHERE url='$link'";

				$dos_result = $this->query($dos_query);

				if(!$dos_result) {
					return $link;
				}
				else {

					$tre_query = unlink(__DIR__."/views/user/".$link.".html");

					if(!$tre_query) {
						return false;
					}
					else {
						return true;
					}

			}

		}

	}

	$ms_pages = new MS_Page_Controller();

?>