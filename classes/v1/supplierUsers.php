<?php
class SupplierUsers{

    // Connection
    private $conn;

    // Table
    private $db_table = "sup_acc_users";
    // Columns
    public $sup_id;
    public $user_name;
    public $password;
    public $first_name;
    public $last_name;
    public $role;
    public $email;
    public $mobile;
    public $address;
    public $profile_pic;
    public $created_at;



    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
	
	/**
	 * @return $this|null
	 */
    public function createSupplierUsers()
    {

        $sqlQuery = "insert into " . $this->db_table . "(user_name,password,first_name,last_name,role,email,mobile,address,profile_pic,created_at) values ( ?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->user_name, $this->password,$this->first_name,$this->last_name,$this->role,$this->email,$this->mobile,$this->address,$this->profile_pic,$this->created_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->sup_id = $dataRow['sup_id'];
            $this->delete_check = $dataRow['delete_check'];
            return $this;
        }

    }
	
	/**
	 * @return $this|null
	 */
    public function updateSupplierUser()
    {

        $sqlQuery = "update " . $this->db_table . " SET user_name = ? ,password = ? ,first_name = ? ,last_name = ? ,role = ? ,email = ? ,mobile = ? ,address = ? ,profile_pic = ? ,updated_at = ? where sup_id = '$this->sup_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->dependant_parts, $this->updated_at]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->sup_id = $dataRow['sup_id'];
            $this->user_name = $dataRow['user_name'];
            $this->password = $dataRow['password'];
            $this->first_name = $dataRow['first_name'];
            $this->last_name = $dataRow['last_name'];
            $this->role = $dataRow['role'];
            $this->email = $dataRow['email'];
            $this->mobile = $dataRow['mobile'];
            $this->address = $dataRow['address'];
            $this->updated_at = $dataRow['updated_at'];
            return $this;
        }

    }
	
	/**
	 * @return $this|null
	 */
    public function deleteSupplierUserById()
    {

        $sqlQuery = "delete from " . $this->db_table . " where sup_id = ?";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->delete_check]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".sup_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->sup_id = $dataRow['sup_id'];

            return $this;
        }

    }
	
	/**
	 * @return $this|null
	 */
    public function setIsDelUser()
    {
        $sqlQuery = "update " . $this->db_table . " SET is_deleted = 1  where sup_id = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->sup_id]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->sup_id = $dataRow['sup_id'];
            return $this;
        }

    }
}