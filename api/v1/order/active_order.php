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

include_once '../../../classes/v1/supplierOrder.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if($jwt){
    try {

        $decoded = JWT::decode($jwt,  new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new supplierOrder($db);

        $data = json_decode(file_get_contents("php://input"));
        $item->order_id = $_POST['order_id'];
        $item->sup_order_id = $_POST['sup_order_id'];
        $item->c_id = $_POST['c_id'];
        $item->order_name = $_POST['order_name'];
        $item->order_desc = $_POST['order_desc'];
        $item->order_active = $_POST['order_active'];
        $item->shipment_details = $_POST['shipment_details'];


        $sgPos = $item->updateActiveOrder();

        if($sgPos != null){
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success" , "order_id" => $sgPos));
        } else{
            http_response_code(401);
            echo json_encode(array("message" => "Order Update failed"));
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
