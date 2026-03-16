<?php

require_once "../Core/Db.php";

class Post 
{


    // creates new post
    public static function create(array $data)
    {


        $sql = "INSERT INTO `posts` (`title`,`author`,`body`)  VALUES (?,?,?)";
        $stmt = Db::connection()->prepare($sql);
        if ($stmt->execute($data)) {
            return true;
        } else {
            return false;
        }
    }

    
    public static function find_post ($id){
        $sql = "SELECT * FROM `posts` WHERE `id` = ? LIMIT 1";
        $stmt = Db::connection()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt ;
        
    }

    public static function all_post(){
        $sql = "SELECT * FROM `posts` ORDER BY `id` DESC";
        $stmt = Db::connection()->query($sql);
        $result =  $stmt->fetchAll();
        return $result;
    }
    
}
