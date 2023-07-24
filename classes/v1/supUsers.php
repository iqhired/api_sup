<?php
	class SupUsers{
		
		// Connection
		private $conn;
		
		// Table
		private $db_table = "sup_users";
		
		// Columns

		// Db connection
		public function __construct($db)
		{
			$this->conn = $db;
		}
	
	}