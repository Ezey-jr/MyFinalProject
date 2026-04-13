<?php
// require_once "../Core/Config.php";
// header('Access-Control-Allow-Origin: *');
// header("Content-Type: application/json");
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

// require_once ROOT."/Controller/PostController.php";

// if ($_SERVER['REQUEST_METHOD'] === "GET") {
//     $all_post = PostController::index();
//     $encoded = json_encode($all_post);
//     echo $encoded;
// }


require_once "../Core/Config.php";
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');


require_once ROOT . "/Core/Db.php";
require_once ROOT . "/Controller/PostController.php";

if ($_SERVER['REQUEST_METHOD'] === "GET") {

    if (!empty($_GET['q'])) {
        $q = '%' . trim($_GET['q']) . '%';

        // ── ADD MORE FIELDS HERE to extend search ──
        $sql = "SELECT * FROM `posts`
                WHERE `title`  LIKE ?
                   OR `author` LIKE ?
                ORDER BY `id` DESC";

        $stmt = Db::connection()->prepare($sql);
        $stmt->execute([$q, $q]);
        echo json_encode($stmt->fetchAll());

    } else {
        $all_post = PostController::index();
        echo json_encode($all_post);
        exit();
    }
}