<?php

	require "modules/ms.connector.php";

	class MS extends MS_Connector {

		public $ms_basepath = "";

		public function set_basepath($path) {
			$this->ms_basepath = $path;
		}
		public function get_basepath () {
			echo $this->ms_basepath;
		}

		public function get_host() {

			return "http://".$_SERVER['HTTP_HOST'].$this->ms_basepath;

		}

		public function echo_host() {
			echo $this->get_host();
		}

		public function add_admin($login, $password, $name) {

			$password = $this->generate($password);

			$login = $this->generate($login);

			$name = $name;

			$result = $this->query("INSERT INTO `adminlist` (id, login, password, name) VALUES (NULL, '$login', '$password', '$name')");

			return $result;

		}

		public function admin_check() {

			$s = $_SESSION;
			$u = isset($_SESSION['user']);
			$a = isset($_SESSION['user']['is_admin']);

			if($s AND $u AND $a) {
				return true;
			}
			else {
				return false;
			}

		}

		public function upload_file($files, $filekey) {

			for($i = 0; $i < sizeof($files) ; $i++) {

				$file = $files[$i];

				$name = $file['name'];
				$tmp = $file['tmp_name'];

				$name = date("YmdHis").substr(microtime(FALSE), 2, 3).basename($name);
				$filepath = __DIR__."/uploads/user/".$name;

				if(move_upload_file($tmp, $filepath)) {

					$query = "INSERT INTO `uploads` (id, name, path, filekey) VALUES (NULL, '$name', '$path', '$filekey')";

					$result_ = $this->query($query);

					if(!$result_) {
						return false;
					}

					return true;

				}
				else {
					return false;
				}

			}

		}

		public function login_in($login, $password) {

			$list = $this->query("SELECT * FROM `adminlist`");

			$list = $this->fetch($list);

			$i = 0 ; 

			while($i < sizeof($list)) {

				if($this->validate($login, $list[$i]['login'])) {

					if($this->validate($password, $list[$i]['password'])) {

						$_SESSION['user'] = $list[$i];

						$_SESSION['user']['is_admin'] = true;

						echo $_SESSION['user']['is_admin'];

					}

					else {

						echo "Неправильно введений пароль. Повторіть спробу";

					}

				}
				else {
					echo "Напривильно введений логін. Повторіть спробу.";
				}

				$i++;
			}

		}

		public function admin_name() {
			echo $_SESSION['user']['name'];
		}


	}

	$ms = new MS();

	$ms->connect();

	$ms->set_basepath("/muzschool");





?>