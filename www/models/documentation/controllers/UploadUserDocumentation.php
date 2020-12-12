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

    $target_dir = "../files/user_documentation/";
    $target_file = $target_dir . basename($_FILES["user_documentation"]["name"]);
    $uploadOk = 1;
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["user_documentation"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["user_documentation"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $user_documentation->create($target_dir . $_FILES["user_documentation"]["name"]);
    
    echo json_encode("OK");
    exit();
}
