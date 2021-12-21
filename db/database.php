<?php 

class DatabaseHelper{

    private $db;

    public function __construct($servername,$username,$password,$dbname,$port=3306){
        $this->db = new mysqli($servername,$username,$password,$dbname,$port);
        if($this->db->connect_error){
            die('Connect failed: ' .$this->db->connect_error);
        }
    }
}

?>