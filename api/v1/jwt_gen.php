<?php
require "../../vendor/autoload.php";
	use Firebase\JWT\JWT;
	use Firebase\JWT\Key;

class JwtHelper {

	static function getJWT() {
		$jwt ='';
		$secretkey = "SupportPassHTSSgmmi";
		$payload = array(
			"author" => "Saargummi to HTS",
			"exp" => time()+10000000
		);
		try{
			$jwt = JWT::encode($payload, $secretkey , 'HS256');
		}catch (UnexpectedValueException $e) {
			echo $e->getMessage();
		}
		return $jwt;
	}

}


?>