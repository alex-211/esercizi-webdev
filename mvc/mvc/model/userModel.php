<?php
    namespace Model;
    
    class UserModel
    {
        private $conn;
        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        public function read()
        {
            $result = $this->conn->query("SELECT * FROM user");
            return $result->fetchAll(); 
        }
    }
?>