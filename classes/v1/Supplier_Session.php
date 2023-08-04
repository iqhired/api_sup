<?php
class Supplier_Session
{
    private $conn;
    private $db_table = "supplier_session_log";
    public  $id;
    public $unique_ord_id;
    public $c_id;
    public $chicagotime;
    public $created_by ;
    public $order_status_id;



    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getSession()
    {

        $sqlQuery = "insert into " . $this->db_table . "(order_id,c_id,order_status_id,created_by,created_on) values (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->unique_ord_id,$this->c_id,$this->order_status_id,$this->created_by,$this->chicagotime]);
        $o_id = $this->unique_ord_id;
        return $o_id;

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".order_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->unique_ord_id = $dataRow['order_id'];
            $this->c_id = $dataRow['c_id'];
            $this->order_status_id = $dataRow['order_status_id'];
            $this->created_on = $dataRow['created_on'];
            return $this;
        }



    }


}

//$part_produce_array = array( new Part_Produced($this->part_number,$this->part_number_extra, $this->part_count));
//
//
//foreach ($part_produce_array as $part) {
//    echo $part->getPartProduced();
//}<?php
