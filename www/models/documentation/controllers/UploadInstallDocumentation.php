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
    include_once "../data/InstallDocumentation.php";

    $database = new Database();
    $db = $database->getConnection();

    $install_documentation = new InstallDocumentation($db);

    $target_dir = "../files/install_documentation/";
    $target_file = $target_dir . basename($_FILES["install_documentation"]["name"]);
    $uploadOk = 1;
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["install_documentation"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["install_documentation"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $install_documentation->create($target_dir . $_FILES["install_documentation"]["name"]);
    exit();
}
