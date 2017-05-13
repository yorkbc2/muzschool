<?php 

	class MS_Hash {

		public function generate($password, $cost = 11) {

			$salt = substr(base64_encode(openssl_random_pseudo_bytes(17)), 0 , 22);

			$salt = str_replace("+", ".", $salt);

			$param = "$".implode('$', array(
				"2y",
				str_pad($cost, 2, "0", STR_PAD_LEFT),
				$salt
			));

			return crypt($password, $param);

		}

		public function validate($password, $hash) {

			return crypt($password, $hash) == $hash;

		}

		public function equal($password, $secondpassword) {
			$bool = hash_equals($password, $secondpassword);

			return $bool;
		}
		
	}

?>