<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/UserDocumentation.php";
    include_once "../data/InstallDocumentation.php";

    $database = new Database();
    $db = $database->getConnection();

    if (explode("type=", $_SERVER['QUERY_STRING'])[1] == "install") {
        $install_documentation = new InstallDocumentation($db);
        $install_documentation->read();
        if (file_exists($install_documentation->path)) {
            unlink($install_documentation->path);
        }
        $install_documentation->delete();
    } 
    else {
        $user_documentation = new UserDocumentation($db);
        $user_documentation->read();
        if (file_exists($user_documentation->path)) {
            unlink($user_documentation->path);
        }
        $user_documentation->delete();
    }

    echo json_encode("OK");
}
