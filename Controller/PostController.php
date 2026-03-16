<?php

require_once "../Models/Post.php";

class PostController {

        public static function index (){
            $data = Post::all_post();
            return $data ;
        }
}