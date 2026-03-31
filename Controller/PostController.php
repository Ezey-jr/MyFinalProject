<?php
require_once  dirname(__DIR__)."/Core/Config.php";
require_once ROOT . "/Models/Post.php";

class PostController
{

    public static function index()
    {
        $data = Post::all_post();
        return $data;
    }

    public static function latest($limit)
    {
        $data = Post::recent($limit);
        return $data;
    }

    public static function add($data)
    {
        if (Post::create($data)) {
            return true;
        }
        return false;
    }


    public static function find($id){
        return Post::find_post($id);

    }

    public static function update ($id, $post_data){
        return Post::update($id, $post_data);
    }
}
