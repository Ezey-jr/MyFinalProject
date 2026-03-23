<?php
require_once "Controller/UserController.php";
require_once "Core/Session.php";
require_once "Core/Message.php";
require_once "Core/Helpers.php";
require_once "Core/Auth.php";
require_once "Controller/PostController.php";
session_start();

$success_msg = "";
$error_msg   = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {


  // ── Sanitize inputs ──
  $title    = Helpers::sanitize($_POST["title"]    ?? "");
  // $slug     = Helpers::sanitize($_POST["slug"]     ?? "");
  $category = Helpers::sanitize($_POST["category"] ?? "");
  $status   = Helpers::sanitize($_POST["status"]   ?? "draft");
  $excerpt  = Helpers::sanitize($_POST["excerpt"]  ?? "");
  $body     = Helpers::sanitize($_POST["body"]     ?? "");
  $meta_desc = Helpers::sanitize($_POST["meta_desc"] ?? "");
  $author = Auth::user()->name;

  // ── Validate ──
  if (strlen($title) < 1 || strlen($body) < 1) {
    $error_msg = "Title and content are required.";
  } else {
    // arrange the data 
    [
      'title' => $title,
      'body' => $body,
      'excerpt' => $excerpt,
      'status' => $status,
      'author' => $author,
      'meta_desc' => $meta_desc,
      'category' => $category
    ];

    if (PostController::add($data)) {
      $success_msg = "Post saved successfully!";
    }
  }
}



$categories = ["Tutorial", "Frontend", "Backend", "Database", "General"];
