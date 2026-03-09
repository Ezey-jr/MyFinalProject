<?php

class Db
{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "soon_delete";
    private $connect;


    public function __construct()
    {

        try {

            $dsn = "mysql:host=$this->host;db_name=$this->db;";
            $pdo = new PDO($dsn, $this->username, $this->password); //new object of PDO created

            // setting PDO attributes:
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //setting error mode
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); //setting fetch mode

            if($pdo){
                echo "connected successfully";
            }
            // $this->connect = $pdo;

        } catch (PDOException $e) {
                echo "Error found:".$e->getMessage();
        }
    }
}


$db = new Db();
