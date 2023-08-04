<?php
class Supplier_Order
{
    private $conn;
    private $db_table = "sup_order";
    public $id;
    public $order_id;
    public $unique_ord_id;
    public $c_id;
    public $order_name;
    public $order_desc;
    public $chicagotime;
    public $created_by;
    public $order_st_id;
    public $modified_on;
    public $delete_check;
    public $is_deleted;
    public $modified_by;


    public function __construct($db)
    {

        $this->conn = $db;
    }

    public function getOrder()
    {

        $sqlQuery = "insert into " . $this->db_table . "(sup_order_id,c_id,order_name,order_desc,order_status_id,order_active,created_on,created_by,is_deleted) values (?,?,?,?,?,?,?,?,?)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->unique_ord_id, $this->c_id, $this->order_name, $this->order_desc, 1, 1, $this->chicagotime, $this->created_by,0]);

        $sqlQuery_sup = "SELECT sup_order_id FROM " . $this->db_table . " WHERE sup_order_id= ?";

        $stmt_sup = $this->conn->prepare($sqlQuery_sup);

        $stmt_sup->bindParam(1, $this->unique_ord_id);

        $stmt_sup->execute();
        $dataRow = $stmt_sup->fetch(PDO::FETCH_ASSOC);

        $this->unique_ord_id = $dataRow['sup_order_id'];

        $o_id = $this->unique_ord_id;
        return $o_id;


    }


    public function getEditOrder()
    {

        if ($this->order_st_id == 6) {
            $sqlQuery = "update " . $this->db_table . " SET order_active = ? , order_status_id = ? , pn_modified_on = ?,pn_modified_by = ? where order_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute([0, $this->order_st_id, $this->modified_on,$this->modified_by,$this->order_id]);


        } else {
            $sqlQuery = "update " . $this->db_table . " SET order_status_id = ? , pn_modified_on = ? ,pn_modified_by = ?  where order_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute([$this->order_st_id,$this->modified_on,$this->modified_by,$this->order_id]);

        }
        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".order_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->order_id = $dataRow['order_id'];
            $this->order_st_id = $dataRow['order_status_id'];
            $this->modified_on = $dataRow['pn_modified_on'];
            $this->modified_by = $dataRow['pn_modified_by'];
            return $this;
        }
    }


        public function getdeleteOrder()
        {

            $sqlQuery = "update " . $this->db_table .  " SET is_deleted = 1  where order_id = ?";

            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute([$this->delete_check]);

            $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table . ".order_id DESC LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery1);
            $stmt->execute();
            $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($dataRow == null || empty($dataRow)) {
                return null;
            } else {
                $this->id = $dataRow['id'];
                $this->order_id = $dataRow['order_id'];
                return $this;
            }


        }

    public function getdelOrder()
    {
        $sqlQuery = "update " . $this->db_table . " SET is_deleted = 1  where order_id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->order_id]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".order_id desc limit 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->id = $dataRow['id'];
            $this->order_id = $dataRow['order_id'];
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
