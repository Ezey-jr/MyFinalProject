<?php
require_once "Core/Db.php";

class User 
{


    // creates new user
    public static function create(array $data)
    {
        $db = new Db ;
        // generate token
        $time = microtime(TRUE);
        $token = md5($time);


        $data[] = $token;
        $sql = "INSERT INTO `users` (`name`,`email`,`password`,`token`)  VALUES (?,?,?,?)";
        $stmt = $db->connection()->prepare($sql);
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }
}
