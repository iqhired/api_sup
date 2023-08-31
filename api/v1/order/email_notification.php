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

include_once '../../../classes/v1/Email_Notification.php';

$jwt = $_SERVER['HTTP_ACCESS_TOKEN'];
if ($jwt) {
    try {

        $decoded = JWT::decode($jwt, new Key($secretkey, 'HS256'));

        // Access is granted. Add code of the operation here

        $database = new Database();
        $db = $database->getConnection();

        $item = new Email_Notification($db);

        $data = json_decode(file_get_contents("php://input"));

        $item->sup_order_id = $_POST['sup_order_id'];
        $item->placed = $_POST['placed'];
        $item->acknowledged = $_POST['acknowledged'];
        $item->Shipment = $_POST["Shipment"];
        $item->Shipped = $_POST["Shipped"];
        $item->Received = $_POST['Received'];
        $item->Closed = $_POST['Closed'];
        $item->Rejected = $_POST['Rejected'];
        $item->created_at = $_POST["created_at"];
        $item->created_by = $_POST["created_by"];


        $sgNotification = $item->getNotification();

        if ($sgNotification != null) {
            http_response_code(200);
            echo json_encode(array("STATUS" => "Success", "sup_order_id" => $sgNotification));
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Email Notification Added. Please retry."));
        }

    } catch (Exception $e) {

        http_response_code(401);

        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }

}

