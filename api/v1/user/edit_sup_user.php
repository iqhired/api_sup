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

include_once '../../../classes/v1/SupplierUsers.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new supplierUsers($db);

        $data = json_decode(file_get_contents("php://input"));
        $item->sup_id = $_POST['sup_id'];
        $item->user_name = $_POST['user_name'];
        $item->u_password = $_POST['u_password'];
        $item->u_firstname = $_POST['u_firstname'];
        $item->u_lastname = $_POST['u_lastname'];
        $item->role = $_POST['role'];
        $item->u_email = $_POST['u_email'];
        $item->u_mobile = $_POST['u_mobile'];
        $item->u_address = $_POST['u_address'];
        $item->u_profile_pic = $_POST['u_profile_pic'];

        $sgPos = $item->updateSupplierUser();

        if($sgPos != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "sup_id" => $sgPos));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "User Update failed"));
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
