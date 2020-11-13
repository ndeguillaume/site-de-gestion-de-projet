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

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
    
    include_once("../../../data/mysql/includes/Database.php");
    include_once("../data/Task.php");

    $database = new Database();
    $db = $database->getConnection();

    $args = explode("&", $_SERVER['QUERY_STRING']);
   
    if (count($args) === 2 ) {
        $task = new Task($db);
        $task_id = explode("=", $args[0])[1];
        $category = explode("=", $args[1])[1];
        if($category === "todo") {
            $task->setTaskToDo($_SESSION["project_id"], $task_id);
        } else if($category === "inprogress") {
            $task->setTaskInProgress($_SESSION["project_id"], $task_id);
        } else if($category === "done") {
            $task->setTaskDone($_SESSION["project_id"], $task_id);
        } else {
            echo json_encode("KO");
        }
    }
   echo json_encode("OK");
}

?>