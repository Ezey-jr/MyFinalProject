<?php

class Helpers
{


    public static function old_value($key_word)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            if (isset($_POST[$key_word])) {
                return $_POST[$key_word];
            }
        } else if ($_SERVER['REQUEST_METHOD'] === "GET") {

            if (isset($_GET[$key_word])) {
                return $_GET[$key_word];
            }
        }
    }

    public static function is_email(string $value) : bool{
        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
            return true;
        }

        return false;
    }

    public static function strong_password(string $password_string){
        if(strlen($password_string) < 6){
            return false;
        }

        return true;
    }
}