<?php

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

require_once "../Controller/PostController.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $all_post = PostController::index();
    $encoded = json_encode($all_post);
    echo $encoded;
}



