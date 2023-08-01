<?php
class activeOrder{

    // Connection
    private $conn;

    // Table
    private $db_table = "sup_order";
    public $order_id;
    public $sup_order_id;
    public $c_id;
    public $order_name;
    public $order_desc;
    public $order_status_id;
    public $order_active;
    public $shipment_details;


    // Columns

    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function updateActiveOrder()
    {

        $sqlQuery = "update " . $this->db_table . " SET order_name = ?  where order_id = '$this->order_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->order_name]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".order_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else
        {
            $this->order_id = $dataRow['order_id'];
            $this->sup_order_id = $dataRow['sup_order_id'];
            $this->c_id = $dataRow['c_id'];
            $this->order_name = $dataRow['order_name'];
            $this->order_desc = $_POST['order_desc'];
            $this->order_active = $_POST['order_active'];
            $this->shipment_details = $_POST['shipment_details'];
            return $this;
        }

    }


}