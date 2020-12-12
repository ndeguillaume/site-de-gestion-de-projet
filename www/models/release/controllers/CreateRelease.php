<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Release.php";
    include_once "../../documentation/data/UserDocumentation.php";
    include_once "../../documentation/data/UserDocumentationHistory.php";
    include_once "../../documentation/data/InstallDocumentation.php";
    include_once "../../documentation/data/InstallDocumentationHistory.php";

    $database = new Database();
    $db = $database->getConnection();
    $release = new Release($db);

    $target_dir = "../files/";
    $target_file = $target_dir . basename($_FILES["release"]["name"]);
    
    if(is_uploaded_file($_FILES['release']['tmp_name'])) {
        if(move_uploaded_file($_FILES['release']['tmp_name'], $target_file)) {
            $user_documentation = new UserDocumentation($db);
            $user_documentation_history = new UserDocumentationHistory($db);
            $install_documentation = new InstallDocumentation($db);
            $install_documentation_history = new InstallDocumentationHistory($db);
            $install_documentation->read();
            $user_documentation->read();
            $install_documentation_history->create($install_documentation->path);
            $install_documentation->delete();
            $user_documentation_history->create($user_documentation->path);
            $user_documentation->delete();
            $release->create($_SESSION['project_id'], $_POST['major'], $_POST['minor'], $_POST['patch'], $target_dir . $_FILES["release"]["name"], $user_documentation_history->getLast()[0], $install_documentation_history->getLast()[0]);
            $finished_issues = explode(",", $_POST['finished_issues']);
            $release_id = $release->getLastRelease()->fetch()['id'];
            foreach ($finished_issues as $args) {
                $release->addFinishedIssue($_SESSION['project_id'], $release_id, $args);
            }
        }
        else{
            echo json_encode("KO");
        }
    }
    else{
        echo json_encode("KO");
    }
    
    echo json_encode("OK");
    exit();
}