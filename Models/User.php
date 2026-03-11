<?php
require_once "Core/Db.php";

class User 
{


    // creates new user
    public static function create(array $data)
    {
        // generate token
        $time = microtime(TRUE);
        $token = md5($time);


        $data[] = $token;
        $sql = "INSERT INTO `users` (`name`,`email`,`password`,`token`)  VALUES (?,?,?,?)";
        $stmt = Db::connection()->prepare($sql);
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    
    public static function find_by_email ($email){
        $sql = "SELECT * FROM `users` WHERE `email` = ? LIMIT 1";
        $stmt = Db::connection()->prepare($sql);
        $stmt->execute([$email]);
        return $stmt ;
        
    }
    
}
