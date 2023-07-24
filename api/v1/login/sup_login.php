<?php
	require "../../../vendor/autoload.php";
	use Firebase\JWT\JWT;
	use Firebase\JWT\Key;
	
	include_once '../../../config/database.php';
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
	include_once '../../../classes/v1/sgUsers.php';
	
	$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
	if($jwt){
		try {
			
			$decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));
			
			// Access is granted. Add code of the operation here
			
			$database = new Database();
			$db = $database->getConnection();
			
			$item = new SgUsers($db);
			
			$data = json_decode(file_get_contents("php://input"));
			
			//TODO add relevant code
			
		}catch (Exception $e){
			
			http_response_code(401);
			
			echo json_encode(array(
				"message" => "Access denied.",
				"error" => $e->getMessage()
			));
		}
		
	}
?>