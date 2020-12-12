<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Sprint.php";
    include_once "../../issue/data/Issues.php";
    include_once "../../issue/data/Issue.php";
    include_once "../../task/data/Tasks.php";
    include_once "../../task/data/Task.php";
    include_once "../../sprint/data/Sprint.php";


    $database = new Database();
    $db = $database->getConnection();

    $tasks = new Tasks($db);
    $task = new Task($db);
    $issues = new Issues($db);
    foreach ($tasks->getTasksTodo() as $task_todo) {
        $related_issues_id = $task->getRelatedIssues($_SESSION['project_id'], $task_todo['fk_task_id']);
        foreach ($related_issues_id as $issue_id) {
            $issue = new Issue($db);
            $issue->removeFromSprint($issue_id['fk_issue_id']);
        }
    }
    foreach ($tasks->getTasksInProgress() as $task_inprogress) {
        $related_issues_id = $task->getRelatedIssues($_SESSION['project_id'], $task_inprogress['fk_task_id']);
        foreach ($related_issues_id as $issue_id) {
            $issue = new Issue($db);
            $issue->removeFromSprint($issue_id['fk_issue_id']);
        }
    }
    $tasks->endSprint();
    $sprint = new Sprint($db);
    $sprint->endSprint($_SESSION['project_id'], explode("id=", $_SERVER['QUERY_STRING'])[1]);
    echo json_encode("OK");
}
