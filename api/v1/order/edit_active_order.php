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

include_once '../../../classes/v1/Supplier_Order.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if ($jwt) {
    try {

        $decoded = JWT::decode($jwt, new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Supplier_Order($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->order_id = $_POST['order_id'];
        $item->order_st_id = $_POST['order_status_id'];
        $item->order_reason = $_POST['order_reason'];
        $item->c_id = $_POST['c_id'];
        $item->modified_on = $_POST['pn_modified_on'];
        $item->modified_by = $_POST['pn_modified_by'];


        $sgEditOrder = $item->getEditOrder();

        if ($sgEditOrder != null) {
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success", "order_st_id" => $sgEditOrder));
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Order edit Failed. Please retry."));
        }


    } catch (Exception $e) {

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

}

