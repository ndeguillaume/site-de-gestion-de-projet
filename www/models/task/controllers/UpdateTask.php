<?php

if (
    (function_exists('session_status')
    && session_status() !== PHP_SESSION_ACTIVE) || !session_id()
) {
    session_start();
}
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Task.php";

    $database = new Database();
    $db = $database->getConnection();
    $args = explode("&", $_SERVER['QUERY_STRING']);
    if (count($args) === 2) {
        $task = new Task($db);

        $task_id = explode("=", $args[0])[1];
        $category = explode("=", $args[1])[1];
        if ($category === "todo") {
            $task->setTaskToDo($_SESSION["project_id"], $task_id);
        } elseif ($category === "inprogress") {
            $task->setTaskInProgress($_SESSION["project_id"], $task_id);
        } elseif ($category === "done") {
            $task->setTaskDone($_SESSION["project_id"], $task_id);
        } else {
            echo json_encode("KO");
        }
    }
    else if(count($args)===7){
        $task = new Task($db);

        $task_id = urldecode(explode("=", $args[0])[1]);
        $task_title = urldecode(explode("=", $args[1])[1]);
        $task_description = urldecode(explode("=", $args[2])[1]);
        $task_dod = urldecode(explode("=", $args[3])[1]);
        $task_duration = urldecode(explode("=", $args[4])[1]);
        $task_parent = explode("=", $args[5])[1];
        $task_related_issues = explode("=", $args[6])[1];

        $task->deleteIssueDependency($_SESSION['project_id'],$task_id);

        $task->deleteParentTask($_SESSION['project_id'],$task_id);

        $task_parent_args = explode(",",$task_parent);
        foreach($task_parent_args as $args){
            $task->addParentTask($_SESSION['project_id'],$task_id,$args);
        }

        $task_related_issues_args = explode(",",$task_related_issues);
        foreach($task_related_issues_args as $args){
            $task->addIssueDependency($_SESSION['project_id'],$task_id,$args);
        }

        if(!$task->update($task_id,$task_title,$task_description,$task_dod,$task_duration)){
            echo json_encode("KO");
        }
    }
    echo json_encode("OK");
}
