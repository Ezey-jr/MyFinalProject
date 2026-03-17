<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    print_r($_POST);
    die();
  // ── Sanitize inputs ──
  $title    = trim($_POST["title"]    ?? "");
  $slug     = trim($_POST["slug"]     ?? "");
  $category = trim($_POST["category"] ?? "");
  $status   = trim($_POST["status"]   ?? "draft");
  $excerpt  = trim($_POST["excerpt"]  ?? "");
  $body     = trim($_POST["body"]     ?? "");
  $meta_desc= trim($_POST["meta_desc"]?? "");

  // ── Validate ──
  if (empty($title) || empty($body)) {
    $error_msg = "Title and content are required.";
  } else {
    // ── INSERT query will go here ──
    // $stmt = $conn->prepare(
    //   "INSERT INTO posts (title, slug, category, status, excerpt, body, meta_desc, created_at)
    //    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())"
    // );
    // $stmt->bind_param("sssssss", $title, $slug, $category, $status, $excerpt, $body, $meta_desc);
    // $stmt->execute();

    $success_msg = "Post saved successfully!";
  }
}

$categories = ["Tutorial", "Frontend", "Backend", "Database", "General"];

?>