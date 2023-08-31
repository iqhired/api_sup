<?php
class Email_Notification
{
    private $conn;
    private $db_table = "email_notification";
    public  $e_id;
    public $sup_order_id;
    public $placed;
    public $acknowledged;
    public $Shipment;
    public $Shipped;
    public $Received;
    public $Closed;
    public $Rejected;
    public $is_deleted;
    public $created_at;
    public $created_by;



    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getNotification()
    {

        $sqlQuery = "insert into " . $this->db_table . "(sup_order_id,placed,acknowledged,Shipment,Shipped,Received,Closed,Rejected,created_at,created_by) values (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->sup_order_id,$this->placed,$this->acknowledged,$this->Shipment,$this->Shipped,$this->Received,$this->Closed,$this->Rejected,$this->created_at,$this->created_by]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".sup_order_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->e_id = $dataRow['e_id'];
            $this->sup_order_id = $dataRow['sup_order_id'];
            $this->placed = $dataRow['placed'];
            $this->acknowledged = $dataRow['acknowledged'];
            $this->Shipment = $dataRow['Shipment'];
            $this->Shipped = $dataRow['Shipped'];
            $this->Received = $dataRow['Received'];
            $this->Closed = $dataRow['Closed'];
            $this->Rejected = $dataRow['Rejected'];
            $this->created_at = $dataRow['created_at'];
            $this->created_by = $dataRow['created_by'];
            return $this;
        }



    }


}

