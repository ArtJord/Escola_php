<?php

 class Database{

   private $host = 'localhost:3306';
    private $db_name = 'escola';
    private $user = 'root';
    private $pass = '1234';

    public $conn;


    public function getConnection(){
        $this->conn = null;

        try {

            $this->conn = new PDO("mysql:host=". $this->host . ";dbname=". $this->db_name, $this->user , $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        
        }

        return $this->conn;

    }



    
}


?>