<?php 

	require "ms.connector.php";

	class MS_Blog extends MS_Connector {

		public $posts = array();
		public $posts_l = 0;

		function __construct() {

			$this->connect();

		}

		function __destruct() {
			$this->close();
		}

		public function remove_post($id) {

			$result = $this->query("DELETE FROM `postlist` WHERE id='$id'");

			return $result;

		}

		public function get_post($id) {

			$post = $this->query_one("SELECT * FROM `postlist` WHERE id='$id'");


			return $post;

		}

		public function edit_post($id) {

		}

		public function add_post($title, $content, $category) {
			$query = "";
			if($category == false || $category == "false") {
				$query = "INSERT INTO `postlist` (id, title, content, views, categoryId) VALUES (NULL, '$title', '$content', 0, 'null')";
			}
			else {
				$query = "INSERT INTO `postlist` (id, title, content, views, categoryId) VALUES (NULL, '$title', '$content', 0, '$category')";
			}

			$result = $this->query($query);

			return $result;


		}

		public function inc_view($id) {

			$result = $this->query("UPDATE `postlist` SET views=views+1 WHERE id='$id'");

			return $result;

		}

		public function get_posts() {

			$query = "SELECT * FROM `postlist`";

			$this->posts = $this->query_fetch($query);
			$this->posts_l = sizeof($this->posts);

			return $this->posts;

		}

		public function add_category($name) {
			$res = $this->query("INSERT INTO `categorylist` (id, name) VALUES (NULL, '$name')");

			return $res;
		}

		public function remove_category($id) {

			$cat = $this->query("DELETE FROM `categorylist` WHERE id='$id'");

			return $cat;

		}

		public function edit_category($id, $name) {

			$cat = $this->query("UPDATE `categorylist` SET name='$name' WHERE id='$id'");

			return $cat;

		}

		public function get_category($id) {

			$cat = $this->query_one("SELECT * FROM `categorylist` WHERE id='$id'");

			return $cat;

		}

		public function get_categories() {

			$cats = $this->query_fetch("SELECT * FROM `categorylist`");

			return $cats;

		}


	}

?>