<?php
require_once dirname(__DIR__) . "/Core/Config.php";
require_once ROOT . "/Core/Db.php";

class Post
{


    // creates new post

    //explain this new parameter in the function signature
    // $data: An array containing the post data to be inserted into the database. This array should include keys corresponding to the column names in the `posts` table (e.g., 'title', 'author', 'body', 'category', 'status', 'excerpt', 'meta_desc', 'user_id', and optionally 'featured_image').only the keys that are present in the $data array will be included in the SQL query, allowing for flexibility in handling posts with or without a featured image.

    
// Fatal error: Uncaught PDOException: SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens in C:\xampp new\htdocs\php_sandbox\project\Models\Post.php:19 Stack trace: #0 C:\xampp new\htdocs\php_sandbox\project\Models\Post.php(19): PDOStatement->execute(Array) #1 C:\xampp new\htdocs\php_sandbox\project\Controller\PostController.php(22): Post::create(Array) #2 C:\xampp new\htdocs\php_sandbox\project\views\components\inc_add_post.php(59): PostController::add(Array) #3 C:\xampp new\htdocs\php_sandbox\project\add-post.php(4): include_once('C:\\xampp new\\ht...') #4 {main} thrown in C:\xampp new\htdocs\php_sandbox\project\Models\Post.php on line 19
// This error occurs when the number of placeholders in the SQL query does not match the number of values provided for binding.
// To fix it, ensure that the $data array contains values for all placeholders in the SQL query.
// where is the error coming from? The error is coming from the `create` method in the `Post` class, specifically at the line where the `execute` method is called on the prepared statement. The error indicates that there is a mismatch between the number of placeholders in the SQL query and the number of values provided in the `$data` array for binding. To resolve this, you need to ensure that the `$data` array contains values for all placeholders defined in the SQL query. 
// here are the two SQL queries in the `create` method:
// 1. When `featured_image` is present:
// ```sqlINSERT INTO `posts` (`title`,`author`,`body`, `category`, `status`, `excerpt`, `meta_desc`, `user_id`, `featured_image`)  VALUES (?,?,?,?,?,?,?,?,?)``
// 2. When `featured_image` is not present:
// ```sqlINSERT INTO `posts` (`title`,`author`,`body`, `category`, `status`, `excerpt`, `meta_desc`, `user_id`)  VALUES (?,?,?,?,?,?,?,?)```
// Make sure that the `$data` array passed to the `create` method contains the correct number of values corresponding to the placeholders in the SQL query being executed. If `featured_image` is included in the `$data` array, it should have 9 values; if it is not included, it should have 8 values.
// where is the data array? The `$data` array is passed as an argument to the `create` method in the `Post` class. It is constructed in the `inc_add_post.php` file when handling the form submission for adding a new post. The relevant code snippet from `inc_add_post.php` is as follows:
// ```php
// $data = [
//   'title' => $title,
//     // 'author' => $author,
//     'body' => $body,
//     'category' => $category,
//     'status' => $status,
//     'excerpt' => $excerpt,
//     'meta_desc' => $meta_desc,
//     // 'user_id' => Auth::user()->id    



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
