<?php
require_once "Session.php";
class Message {
    // start a session

    public static function setMessage ($message){
        // start rhe session
    
        return $_SESSION['message'] = $message ;
    }

    public static function check (){

        if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
            return true;
        }

        return false;
    }

    public static function getMessage (){
        $message = $_SESSION['message'];
        Session::delete("message");
        return $message;

    }
}
