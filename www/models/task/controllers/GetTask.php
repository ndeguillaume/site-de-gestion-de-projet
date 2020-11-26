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

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Task.php";
    include_once "../data/Tasks.php";
    include_once "../../issue/data/Issues.php";
    include_once "../../sprint/data/Sprints.php";

    $database = new Database();
    $db = $database->getConnection();

    $task = new Task($db);
    $tasks = new Tasks($db);
    $issues = new Issues($db);
    $sprints = new Sprints($db);

    $task->read($_GET["id"]);
    $active_sprint_id = $sprints->getActiveSprint()['id'];

    $active_sprint_issues_id= ""; 
    foreach($issues->getIssuesBySprint($active_sprint_id) as $row){
        $active_sprint_issues_id .= $row["id"].',';
    }

    $tasks_id = "";
    foreach($tasks->getTasks() as $row){
        $tasks_id .= $row["id"].',';
    }

    $response_issues = "";
    foreach($task->getRelatedIssues($_SESSION['project_id'],$task->id) as $row){
        $response_issues .= $row['fk_issue_id'].",";
    }

    $response_tasks = "";
    foreach($task->getParentTask($_SESSION['project_id'],$task->id) as $row){
        $response_tasks .= $row['parent_task_id'].",";
    }

    echo json_encode(
        array(
            $task->id,
            $task->title,
            $task->description,
            $task->dod,
            $task->duration,
            mb_substr($active_sprint_issues_id,0,-1),
            mb_substr($tasks_id,0,-1),
            mb_substr($response_issues,0,-1),
            mb_substr($response_tasks,0,-1)
        )
    );
}
