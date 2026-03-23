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


  die(var_dump($_FILES));
    $tmp_file = $_FILES['featured_image']['tmp_name'];
    $upload_file_name = $_FILES['featured_image']['name'];
    $new_array = explode(".", $upload_file_name);
    $extension = end($new_array);


    $new_file_name = time() . "." . $extension;
    $full_file_path = "assets/file_uploads/" . $new_file_name;

    // moving uploaded file
    move_uploaded_file($tmp_file, $full_file_path);

    // arrange the data 
    $data = [
      'title' => $title,
      'excerpt' => $excerpt,
      'author' => $author,
      'body' => $body,
      'category' => $category,
      'status' => $status,
      'meta_desc' => $meta_desc,
      'user_id' => Auth::user()->id
    ];
    if (strlen($tmp_file) > 1) {
      $data['featured_image'] = $new_file_name;
      if (PostController::add($data)) {
        $success_msg = "Post saved successfully!";
      }
    } else {
      if (PostController::add($data)) {
        $success_msg = "Post saved successfully!";
      }
    }
  }
}



$categories = ["Tutorial", "Frontend", "Backend", "Database", "General"];
