<?php 

	require "includes/AltoRouter.php";

	require "ms.php";

	class MS_Router extends MS {

		public $routes = array();

		public $user_view = __DIR__."/views/user/";
		public $req_view = __DIR__."/views/req/";

		public $basepath = "";

		

		function __construct($basepath = "") {

			$this->router = new AltoRouter();

			$this->router->setBasePath($basepath);

			$this->basepath = $basepath;

			$this->connect();

		}

		function __destruct() {

			$this->close();

		}

		public function redirect($path) {

			header("Location: ".$this->basepath.$path);
			exit;

		}

		public function add_route($name, $link) {

			$able = $this->query("SELECT * FROM `routelist`");
			$able = $this->fetch($able);

			$likethis = $this->query("SELECT * FROM `routelist` WHERE url='$link'");

			$likethis = mysqli_fetch_array($likethis);

			if($likethis['url'] AND $likethis['page']) {
				return false;
			}
			else {
				$new_route = $this->query("INSERT INTO `routelist` (id, url, page) VALUES (NULL, '$link', '$link')");

				return true;
			}

		}

		public function get_routes() {

			$routes = $this->query("SELECT * FROM `routelist`");

			$routes = $this->fetch($routes);

			return $routes;

		}

		public function create() {

			$routes = $this->get_routes();

			for($i = 0 ; $i < sizeof($routes) ; $i++) {

				$this->map($routes[$i]);

			}

			$this->create_req_maps();

			$this->match();

		}

		private function create_req_maps() {

			$r = $this->router;

			$r->map("GET", "/", function () {

				global $ms;

				require $this->req_view."index.html";

			});

			$r->map("GET", "/login", function () {

				global $ms;

				$check = $ms->admin_check();

				if($check) {

					$this->redirect('/admin-panel');

				}
				else {

					require $this->req_view."login.php";

				}

			});

			$r->map("GET", "/admin-panel", function () {

				global $ms;

				if($ms->admin_check()) {

					require $this->req_view."admin-panel.php";

				}
				else {
					$this->redirect('/login');
				}

			});

			$r->map("GET", "/edit/page/[i:id]", function ($id) {
				global $ms;
				
				$postId = $id;
				$pageItem = array();
				$contentItem = "";

				if($ms->admin_check()) {
					$page = $ms->query("SELECT * FROM `pagelist` WHERE id='$id'");

					$page = mysqli_fetch_array($page);

					if(isset($page['name'])) {

						$pageItem = $page;
						$contentItem = $this->open_file(__DIR__."/views/user/".$pageItem['link'].".html");

						


					}
					else {
						$this->redirect('/');
					}

					require $this->req_view."edit.php";
				}
				else {
					$this->redirect('/login');
				}

			});

			$r->map("GET", "/logout", function () {

				$_SESSION['user'] = array();

				$this->redirect('/');

			});

			$r->map("GET", '/404', function () {
				global $ms;
				require $this->req_view."404.php";
			});

			

		}

		private function map($route) {


				$this->middle_route = $route;

			$this->router->map("GET", "/".$route['url'], function () {

				require $this->user_view.$this->middle_route['page'].'.html';

			});

		}

		private function match() {

			$match = $this->router->match();

			if($match && is_callable($match['target'])) {

				call_user_func_array($match['target'], $match['params']);

			}
			else {

				$this->redirect('/404');

			}

		}

	}

	$router = new MS_Router("/muzschool");

	
?>