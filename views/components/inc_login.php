<?php
require_once "Controller/UserController.php";
require_once "Core/Session.php";
require_once "Core/Message.php";
require_once "Core/Helpers.php";

// start session everytime
// Session::start();

$errors = [];

// checking the request method
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $required_fields = ['password', 'email'];
    $post_data = $_POST;
    foreach ($post_data as $field => $data) {
        if (in_array($field, $required_fields) && empty($data)) {
            $errors[] = "$field cannot be empty";
        }
    }

    if (empty($errors)) {
        //    next stage: getting fields data for validation
        $email = $_POST['email'];
        $password = $_POST['password'];


        //  checking is email is valid
        if (!Helpers::is_email($email)) {
            $errors[] = "invalid email";
        }

        if (!UserController::emailExist($email)) {
            $errors[] = "incorrect password or email";
        }
    }


    // storing datas to the data base
    if (empty($errors)) {
        if (UserController::process_login($email, $password)) {
            // storing user data 
            Message::setMessage("Welcome to 2026 blog of the Year.");
            header("Location:index.php");
            exit;
        } else {
            $errors[] = "incorrect password or email";
        }
    }
}
