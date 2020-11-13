<?php
if ((function_exists('session_status') 
&& session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
session_start();
}
?>
<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once("../../../data/mysql/includes/Database.php");
    include_once("../data/Sprint.php");
    include_once("../../issue/data/Issues.php");
    include_once("../../issue/data/Issue.php");
    include_once("../../task/data/Tasks.php");
    include_once("../../task/data/Task.php");

    $database = new Database();
    $db = $database->getConnection();

    $id = $_POST["id"];
    $begin_date = $_POST["begin_date"];
    $end_date = $_POST["end_date"];
    $s = new Sprint($db);
    $s->startSprint($_SESSION["project_id"], $id, $begin_date, $end_date);

    $issues = new Issues($db);
    $issuesList = $issues->getIssuesBySprint($id);

    foreach($issuesList as $i){
        $issue = new Issue($db);
        $taskList = $issue->getRelatedTasks($i['id']);
        foreach($taskList as $t){
            $task = new Task($db);
            $task->setTaskToDo($_SESSION["project_id"], $t['fk_task_id']);
        }
    }
    echo json_encode("OK");
}

?>