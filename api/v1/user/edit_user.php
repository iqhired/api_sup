<?php
require "../../../vendor/autoload.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

include_once '../../../config/database.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../../classes/v1/createUsers.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new createUsers($db);

        $data = json_decode(file_get_contents("php://input"));
        $item->user_name = $_POST['user_name'];
        $item->password = $_POST['password '];
        $item->first_name = $_POST['first_name'];
        $item->last_name = $_POST['last_name'];
        $item->role = $_POST['role'];
        $item->email = $_POST['email'];
        $item->mobile = $_POST['mobile'];
        $item->address = $_POST['address'];
        $item->profile_pic = $_POST['profile_pic'];

        $item->updated_at = $_POST['updated_at'];

        $sgPos = $item->getEditCreateUser();

        if($sgPos != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "sup_id" => $sgPos));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "User create failed"));
        }

    }catch (Exception $e){

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

}
?>
