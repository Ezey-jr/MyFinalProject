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
  // $author = Auth::user()->name;



  // ── Validate ──
  if (strlen($title) < 1 || strlen($body) < 1) {
    $error_msg = "Title and content are required.";
  } else {


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
      'author' => $author,
      'body' => $body,
      'category' => $category,
      'status' => $status,
      'excerpt' => $excerpt,
      'meta_desc' => $meta_desc,
      'user_id' => Auth::user()->id
    ];


// Warning: Undefined variable $author in C:\xampp new\htdocs\php_sandbox\project\views\components\inc_add_post.php on line 49

// Warning: Attempt to read property "id" on null in C:\xampp new\htdocs\php_sandbox\project\views\components\inc_add_post.php on line 55

// Fatal error: Uncaught PDOException: SQLSTATE[42S22]: Column not found: 1054 Unknown column 'user_id' in 'field list' in C:\xampp new\htdocs\php_sandbox\project\Models\Post.php:45 Stack trace: #0 C:\xampp new\htdocs\php_sandbox\project\Models\Post.php(45): PDOStatement->execute(Array) #1 C:\xampp new\htdocs\php_sandbox\project\Controller\PostController.php(22): Post::create(Array) #2 C:\xampp new\htdocs\php_sandbox\project\views\components\inc_add_post.php(59): PostController::add(Array) #3 C:\xampp new\htdocs\php_sandbox\project\add-post.php(4): include_once('C:\\xampp new\\ht...') #4 {main} thrown in C:\xampp new\htdocs\php_sandbox\project\Models\Post.php on line 45

// explain the errors and how to fix them:
// 1. Undefined variable $author: This error occurs because the variable $author is being used in the code without being defined or assigned a value. To fix this, you need to ensure that the $author variable is properly defined and assigned a value before it is used. For example, you can set $author to the name of the currently authenticated user using Auth::user()->name.
// 2. Attempt to read property "id" on null: This error occurs because the code is trying to access the "id" property of a null value. This likely happens because Auth::user() is returning null, which means that there is no authenticated user. To fix this, you need to ensure that the user is properly authenticated before trying to access their properties. You can add a check to see if Auth::check() returns true before accessing Auth::user()->id.












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
