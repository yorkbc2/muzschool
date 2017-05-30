<?php 

	require "ms.pages.php";

	class MS_Blog extends MS_Page_Controller {

		public $posts = array();
		public $posts_l = 0;

		function __construct() {

			$this->connect();

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

		public function add_post($title, $content, $category, $date) {
			$query = "";
			if($category == false || $category == "false" || $category == "") {
				$query = "INSERT INTO `postlist` (id, title, content, views, categoryId, date) VALUES (NULL, '$title', '$content', 0, 'null', '$date')";
			}
			else {
				$query = "INSERT INTO `postlist` (id, title, content, views, categoryId) VALUES (NULL, '$title', '$content', 0, '$category', '$date')";
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

		public function get_popular($limit) {

			$posts = $this->query_fetch("SELECT * FROM `postlist` ORDER BY views DESC LIMIT 0,5");

			return $posts;

		}

		public function echo_popular($bp) {

			$posts = $this->get_popular(5);

			for($i = 0 ; $i < sizeof($posts) ; $i++) {

				echo "<li><i class='fa fa-eye'></i> ".$posts[$i]['views']."<a href='".$bp."/blog/post/".$posts[$i]['id']."'>
					".$posts[$i]['title']."
				</a>
				<section class='_li_content'>
				<a href='".$bp."/blog/post/".$posts[$i]['id']."'>
					".$posts[$i]['content']."
				</a>
				</section></li>";

			}

		}


	}

	$blog = new MS_Blog();

?>