<?php
if ((function_exists('session_status') 
&& session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
session_start();
}
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    include_once("../../../data/mysql/includes/Database.php");
    include_once("../data/Task.php");
    include_once("../data/Tasks.php");

    $database = new Database();
    $db = $database->getConnection();

    $task = new Task($db);
    $task->create($_POST["title"]);

    echo json_encode("OK");
}

?>