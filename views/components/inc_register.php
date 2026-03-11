<?php
require_once "Controller/UserController.php";
require_once "Core/Session.php";
require_once "Core/Message.php";

// start session everytime
Session::start();

$errors = [];

// checking the request method
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $required_fields = ['name', 'password', 'password_again', 'email'];
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
        $name = $_POST['name'];
        $password_again = $_POST['password_again'];

        //  checking is email is valid
        if (!Helpers::is_email($email)) {
            $errors[] = "invalid email";
        }

        // checking if email exist
        if (UserController::emailExist($email)) {
            $errors[] = "email already exist";
        }


        if (!Helpers::strong_password($password)) {
            $errors[] = "password should be at least 6 characters long";
        }

        if ($password !== $password_again) {
            $errors[] = "password does not match";
        }
    }


    // storing datas to the data base
    if (empty($errors)) {

        $user_controller = new UserController;
        // encrypt password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            $name,
            $email,
            $hashed_password
        ];

        // storing user data 
        if ($user_controller->store($data)) {
            Message::setMessage("Registration has been completed successfully.");
            header("Location:login.php");
            exit;
        }
    }
}
