<?php
require_once "Core/Config.php";
require_once ROOT."/Models/Post.php";

class PostController {

        public static function index (){
            $data = Post::all_post();
            return $data ;
        }

        public static function latest ($limit){
            $data = Post::recent($limit);
            return $data ;
        }
}