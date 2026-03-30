<?php

// ── Handle update ──
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    // ── Sanitize inputs ──
    $title    = Helpers::sanitize($_POST["title"]    ?? "");
    $slug     = Helpers::sanitize($_POST["slug"]     ?? "");
    $category = Helpers::sanitize($_POST["category"] ?? "");
    $status   = Helpers::sanitize($_POST["status"]   ?? "draft");
    $excerpt  = Helpers::sanitize($_POST["excerpt"]  ?? "");
    $body     = Helpers::sanitize($_POST["body"]     ?? "");
    $meta_desc = Helpers::sanitize($_POST["meta_desc"] ?? "");

    if (empty($title) || empty($body)) {
        $error_msg = "Title and content are required.";
    } else {
        // arrange the data 
        $data = [
            $title,
            $excerpt,
            $body,
            $category,
            $status,
            $meta_desc
        ];

        PostController::update($id, $data);
        $success_msg = "Post updated successfully!";
    }
}
