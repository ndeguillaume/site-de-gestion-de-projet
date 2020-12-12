<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Location: ../views/Documentation.php');
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/UserDocumentation.php";

    $database = new Database();
    $db = $database->getConnection();

    $user_documentation = new UserDocumentation($db);
    $user_documentation->read();
    if (file_exists($user_documentation->path)) {
        unlink($user_documentation->path);
    }
    $user_documentation->delete();
    $user_documentation->create($_GET["path"]);
    echo json_encode("OK");
    exit();
}
