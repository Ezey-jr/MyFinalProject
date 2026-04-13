<?php
require_once "../Core/Config.php";
require_once ROOT . "/Core/Db.php";

class Post
{


    // creates new post
    public static function create(array $data)
    {

        if (isset($data['featured_image']) && !empty($data['featured_image'])) {
            $sql = "INSERT INTO `posts` (`title`,`author`,`body`, `category`, `status`, `excerpt`, `meta_desc`, `user_id`, `featured_image`)  VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = Db::connection()->prepare($sql);

            $data = array_values($data);

            if ($stmt->execute($data)) {
                return true;
            } else {
                return false;
            }
        } else {
            $sql = "INSERT INTO `posts` (`title`,`author`,`body`, `category`, `status`, `excerpt`, `meta_desc`, `user_id`)  VALUES (?,?,?,?,?,?,?,?)";
            $stmt = Db::connection()->prepare($sql);

            $data = array_values($data);
            if ($stmt->execute($data)) {
                return true;
            } else {
                return false;
            }
        }
    }


    public static function find_post($id)
    {
        $sql = "SELECT * FROM `posts` WHERE `id` = ? LIMIT 1";
        $stmt = Db::connection()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }

    public static function all_post()
    {
        $sql = "SELECT * FROM `posts` ORDER BY `id` DESC";
        $stmt = Db::connection()->query($sql);
        $result =  $stmt->fetchAll();
        return $result;
    }

    public static function update($id, $post_data){
        $sql = "UPDATE `posts` SET `title` = ?, `excerpt` = ?,  `body` = ?,  `category` = ?, `status` = ?, `meta_desc` = ? WHERE `id` = '$id' LIMIT 1";

        $stmt = DB::connection()->prepare($sql);
        if($stmt->execute($post_data)){
            return true;
        }else{
            return false;
        }


    }

    public static function recent(int $limit)
    {
        $sql = "SELECT * FROM `posts` ORDER BY `id` DESC LIMIT $limit";
        $stmt = Db::connection()->query($sql);
        $result = $stmt->fetchAll();
        return $result;
    }
}
