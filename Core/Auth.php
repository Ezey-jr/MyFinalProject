
<?php

require_once "Session.php";
require_once "Helpers.php";

class Auth
{

    public static function login(object $user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user'] = $user;
    }

    public static function user()
    {
        return $_SESSION['user'];
    }

    public static function check()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }


    // checks if a user is logged in if not it redirects user to the login page
    public static function login_redirect()
    {
        if (self::check() === false) {
            Helpers::redirect("login.php");
        }
    }

    // checks if a user is  logged in if yes it redirects user to the index page
    public static function logout_redirect()
    {
        if (self::check() === true) {
            Helpers::redirect("index.php");
        }
    }
}
