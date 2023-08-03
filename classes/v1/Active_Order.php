<?php
class Active_Order
{
    private $conn;
    private $db_table = "sup_order";
    public  $id;
    public $unique_ord_id;
    public $c_id;
    public $order_name;
    public $order_desc;
    public $chicagotime;
    public $created_by ;



    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getOrder()
    {

        $sqlQuery = "insert into " . $this->db_table . "(sup_order_id,c_id,order_name,order_desc,order_status_id,order_active,created_on,created_by) values (?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->unique_ord_id,$this->c_id,$this->order_name,$this->order_desc,1,1,$this->chicagotime,$this->created_by]);

        $sqlQuery_sup= "SELECT sup_order_id FROM ". $this->db_table ." WHERE sup_order_id= ?";

        $stmt_sup = $this->conn->prepare($sqlQuery_sup);

        $stmt_sup->bindParam(1, $this->unique_ord_id);

        $stmt_sup->execute();
        $dataRow = $stmt_sup->fetch(PDO::FETCH_ASSOC);

        $this->unique_ord_id = $dataRow['sup_order_id'];

        $o_id = $this->unique_ord_id;
        return $o_id;

        $sqlQuery_log = "insert into supplier_session_log" . "(order_id,c_id,order_status_id,created_by,created_on) values (?,?,?,?,?)";
        $stmt_log = $this->conn->prepare($sqlQuery_log);
        $stmt_log->execute([$this->unique_ord_id,$this->c_id,1,$this->created_by,$this->chicagotime]);
    }

    public function getEditQualityAlert()
    {

        if (empty($this->ok_image) && empty($this->nok_image)){
            $sqlQuery = "update " . $this->db_table . " SET qa = ?, part_number = ? , station = ? , part_family = ? ,prod_area = ? , internal = ? , customer = ? , external = ? , dependent_ans = ? ,user = ? , closed_by = ? , updated_at = ? ,closed_date = ?   where part_number = '$this->part_number'";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute([$this->qa,$this->part_number,$this->station , $this->part_family , $this->prod_area , $this->internal, $this->customer , $this->external ,  $this->dependent_ans, $this->user ,$this->closed_by, $this->updated_at,$this->closed_date]);

        }else if (empty($this->ok_image)){
            $sqlQuery = "update " . $this->db_table . " SET qa = ?, part_number = ? , station = ? , part_family = ? ,prod_area = ? , internal = ? , customer = ? , external = ? , dependent_ans = ? ,user = ? , closed_by = ? , updated_at = ? ,closed_date = ? , nok_image = ? where part_number = '$this->part_number'";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute([$this->qa,$this->part_number,$this->station , $this->part_family , $this->prod_area , $this->internal, $this->customer , $this->external ,  $this->dependent_ans, $this->user ,$this->closed_by, $this->updated_at,$this->closed_date,$this->nok_image]);

        }else if (empty($this->nok_image)){
            $sqlQuery = "update " . $this->db_table . " SET qa = ?, part_number = ? , station = ? , part_family = ? ,prod_area = ? , internal = ? , customer = ? , external = ? , dependent_ans = ? ,user = ? , closed_by = ? , updated_at = ? ,closed_date = ? , ok_image = ?  where part_number = '$this->part_number'";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute([$this->qa,$this->part_number,$this->station , $this->part_family , $this->prod_area , $this->internal, $this->customer , $this->external ,  $this->dependent_ans, $this->user ,$this->closed_by, $this->updated_at,$this->closed_date,$this->ok_image]);

        }else{
            $sqlQuery = "update " . $this->db_table . " SET qa = ?, part_number = ? , station = ? , part_family = ? ,prod_area = ? , internal = ? , customer = ? , external = ? , dependent_ans = ? ,user = ? , closed_by = ? , updated_at = ? ,closed_date = ? , ok_image = ? , nok_image = ? where part_number = '$this->part_number'";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute([$this->qa,$this->part_number,$this->station , $this->part_family , $this->prod_area , $this->internal, $this->customer , $this->external ,  $this->dependent_ans, $this->user ,$this->closed_by, $this->updated_at,$this->closed_date,$this->ok_image,$this->nok_image]);

        }


        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->part_number    = $dataRow['part_number'];
            $this->dependent_ans  = $dataRow['dependent_ans'];
            $this->created_at     = $dataRow['created_at'];
            $this->updated_at     = $dataRow['updated_at'];
            return $this;
        }

    }

    public function getdeleteQualityAlert()
    {

        $sqlQuery = "delete from " . $this->db_table . " where id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->delete_check]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->part_number = $dataRow['part_number'];

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
