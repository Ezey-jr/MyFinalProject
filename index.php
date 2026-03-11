<?php
require_once "Controller/UserController.php";
require_once "Core/Session.php";
require_once "Core/Message.php";
require_once "Core/Helpers.php";
require_once "Core/Auth.php";


// start session everytime
Session::start();

$user = Auth::user();
echo "Hi,". $user->name;
