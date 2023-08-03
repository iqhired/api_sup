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



    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getSession()
    {

        $sqlQuery = "insert into " . $this->db_table . "(order_id,c_id,order_status_id,created_by,created_on) values (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->unique_ord_id,$this->c_id,1,$this->created_by,$this->chicagotime]);
        $o_id = $this->unique_ord_id;
        return $o_id;



    }


}

//$part_produce_array = array( new Part_Produced($this->part_number,$this->part_number_extra, $this->part_count));
//
//
//foreach ($part_produce_array as $part) {
//    echo $part->getPartProduced();
//}<?php
