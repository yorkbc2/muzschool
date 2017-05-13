<?php 

	require "includes/AltoRouter.php";

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

		public function add_route($route_name, $route_page) {

			$new_router = array(
				"link" => $route_name,
				"page" => $route_page
			);

			$able = $this->query("SELECT * FROM `routelist` WHERE page='$route_page'");

			$able = $this->fetch($able);

			if($route_page['page'] == $able['page']) {

				echo "Таке посилання вже зайняте.";

			}
			else {
				$result = $this->query("INSERT INTO `routelist` (id, url, page) VALUES (NULL, '$route_name', '$route_page')");

				array_push($this->routes, $new_router);

				return $result;
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

				require $this->user_view.$this->middle_route['page'].'.php';

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
	
?>