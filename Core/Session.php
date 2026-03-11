<?php


 class Session {
    // starts a new session
     public static function start (){
        return session_start();
     }

     public static function stop (){
        (new self)::start();
        return session_destroy();
     }

     public static function delete(string $session_name){
        unset($_SESSION[$session_name]);
     }
 }