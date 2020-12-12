<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

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
    $sprint_issues = $issues->getIssuesBySprint($active_sprint_id);
    if (is_array($sprint_issues) || is_object($sprint_issues)) {
        foreach($sprint_issues as $row){
            $active_sprint_issues_id .= $row["id"].',';
        }
    }

    $non_selected_tasks_id = "";
    $all_tasks = $tasks->getTasks();
    if (is_array($all_tasks) || is_object($all_tasks)) {
        foreach($all_tasks as $row){
            if($row["id"] !== $_GET["id"]){
                $non_selected_tasks_id .= $row["id"].',';
            }
        }
    }

    $response_issues = "";
    $related_issues = $task->getRelatedIssues($_SESSION['project_id'],$task->id);
    if (is_array($related_issues) || is_object($related_issues)) {
        foreach($related_issues as $row){
            $response_issues .= $row['fk_issue_id'].",";
        }
    }

    $response_tasks = "";
    $parent_tasks = $task->getParentTasks($_SESSION['project_id'],$task->id);
    if (is_array($parent_tasks) || is_object($parent_tasks)) {
        foreach($parent_tasks as $row){
            $response_tasks .= $row['parent_task_id'].",";
        }
    }

    echo json_encode(
        array(
            $task->id,
            $task->title,
            $task->description,
            $task->dod,
            $task->duration,
            mb_substr($active_sprint_issues_id,0,-1),
            mb_substr($non_selected_tasks_id,0,-1),
            mb_substr($response_issues,0,-1),
            mb_substr($response_tasks,0,-1)
        )
    );
}
