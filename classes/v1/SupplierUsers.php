<?php
class SupplierUsers{

    // Connection
    private $conn;

    // Table
    private $db_table = "sup_account_users";
    // Columns
    public $sup_id;
    public $c_id;
    public $user_name;
    public $role;
    public $u_email;
    public $u_password;
    public $u_firstname;
    public $u_lastname;
    public $u_mobile;
    public $u_address;
    public $u_profile_pic;
    public $u_type;
    public $u_status;
    public $delete_check;




    // Db connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
	
	/**
	 create supplier User
	 */
    public function createSupplierUsers()
    {

        $sqlQuery = "insert into " . $this->db_table . "(user_name,u_password,u_firstname,u_lastname,role,u_email,u_mobile,u_address,u_profile_pic) values (?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->user_name, $this->u_password,$this->u_firstname,$this->u_lastname,$this->role,$this->u_email,$this->u_mobile,$this->u_address,$this->u_profile_pic]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".sup_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else {
            $this->sup_id = $dataRow['sup_id'];
            $this->c_id = $dataRow['c_id'];
            $this->user_name = $dataRow['user_name'];
            $this->role = $dataRow['role'];
            $this->u_email = $dataRow['u_email'];
            $this->u_password = $dataRow['u_password'];
            $this->u_firstname = $dataRow['u_firstname'];
            $this->u_lastname = $dataRow['u_lastname'];
            $this->u_mobile = $dataRow['u_mobile'];
            $this->u_address = $dataRow['u_address'];
            $this->u_profile_pic = $dataRow['u_profile_pic'];
            $this->u_type = $dataRow['u_type'];
            $this->u_status = $dataRow['u_status'];
            return $this;
        }

    }
	
	/**
   update supplier User
	 */
    public function updateSupplierUser()
    {

        $sqlQuery = "update " . $this->db_table . " SET user_name = ? ,u_password = ? ,u_firstname = ? ,u_lastname = ? ,role = ? ,u_email = ? ,u_mobile = ? ,u_address = ? ,u_profile_pic = ?  where sup_id = '$this->sup_id'";

        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute([$this->user_name,$this->u_password,$this->u_firstname,$this->u_lastname,$this->role,$this->u_email,$this->u_mobile,$this->u_address,$this->u_profile_pic]);

        $sqlQuery1 = "SELECT * FROM " . $this->db_table . " ORDER BY " . $this->db_table. ".sup_id DESC LIMIT 0,1";
        $stmt = $this->conn->prepare($sqlQuery1);
        $stmt->execute();
        $dataRow = $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dataRow == null || empty($dataRow)) {
            return null;
        } else
        {
            $this->sup_id = $dataRow['sup_id'];
            $this->user_name = $dataRow['user_name'];
            $this->u_password = $dataRow['u_password'];
            $this->u_firstname = $dataRow['u_firstname'];
            $this->u_lastname = $dataRow['u_lastname'];
            $this->role = $dataRow['role'];
            $this->u_email = $dataRow['u_email'];
            $this->u_mobile = $dataRow['u_mobile'];
            $this->u_address = $dataRow['u_address'];
            $this->u_profile_pic = $dataRow['u_profile_pic'];
            return $this;
        }

    }
	
	/**
   delete supplier User
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
            $this->user_name = $dataRow['user_name'];

            return $this;
        }

    }
	

}