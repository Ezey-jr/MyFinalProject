<?php
require_once "Core/Helpers.php";

session_start();
session_destroy();

// redirect after logout
Helpers::redirect("login.php");
