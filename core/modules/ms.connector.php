<?php 

	require "ms.template.php";

	class MS_Connector extends MS_Template {

		private $info = array(
			"name" => "muz_database",
			"host" => "127.0.0.1",
			"user" => "root",
			"password" => ""
		);


		public $connect = "";

		public function connect() {

			$l = $this->info;

			$this->connect = mysqli_connect($l['host'], $l['user'], $l['password'], $l['name']) or die("Неможливо підключитися до Бази Даних");



			return $this->connect;

		}

		public function query ($query) {

			$result = mysqli_query($this->connect, $query);

			if(!$result) {

				die("Неможливе виконання заклилку.".mysqli_error($this->connect));

			}

			return $result;

		}

		public function fetch($result) {

			$array = array();

			$i = 0 ;

			while($row = mysqli_fetch_array($result)) {

				$array[$i] = $row;

				$i++;

			}

			return $array;	

		}

		public function query_fetch($query) {

			$res = $this->query($query);
			$res = $this->fetch($res);

			return $res;

		}

		public function close() {

			mysqli_close($this->connect) or die("Неможливо відключитися від Бази Даних");

			return $this->connect;

		}

	}

 ?>