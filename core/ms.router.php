<?php 

	require "includes/AltoRouter.php";

	class MS_Router extends MS {

		public $routes = array();

		public $user_view = __DIR__."/views/user/";

		function __construct($basepath = "") {

			$this->router = new AltoRouter();

			$this->router->setBasePath($basepath);

			$this->connect();

		}

		function __destruct() {

			$this->close();

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

			$this->match();

		}

		public function map($route) {


				$this->middle_route = $route;

			$this->router->map("GET", "/".$route['url'], function () {


				require $this->user_view.$this->middle_route['page'].'.php';

			});

		}

		public function match() {

			$match = $this->router->match();

			if($match && is_callable($match['target'])) {

				call_user_func_array($match['target'], $match['params']);

			}
			else {

				header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');

			}

		}

	}
	
?>