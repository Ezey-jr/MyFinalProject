
<?php

require_once "Session.php";

class Auth {

        public static function login(object $user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user'] = $user ;
        }

        public static function user (){
            return $_SESSION['user'];
        }



}