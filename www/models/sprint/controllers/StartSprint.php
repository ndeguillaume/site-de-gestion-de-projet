<?php
// Headers requis
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Sprint.php";
    include_once "../../issue/data/Issues.php";
    include_once "../../issue/data/Issue.php";
    include_once "../../task/data/Tasks.php";
    include_once "../../task/data/Task.php";

    $database = new Database();
    $db = $database->getConnection();

    $id = $_POST["id"];
    $begin_date = $_POST["begin_date"];
    $end_date = $_POST["end_date"];
    $s = new Sprint($db);
    $s->startSprint($_SESSION["project_id"], $id, $begin_date, $end_date);

    $issues = new Issues($db);
    $issues_list = $issues->getIssuesBySprint($id);
    $tasks_to_add = [];
    foreach ($issues_list as $i) {
        $issue = new Issue($db);
        $task_list = $issue->getRelatedTasks($i['id']);
        if ($task_list != "") {
            foreach ($task_list as $t) {
                $task = new Task($db);
                if (!in_array([$_SESSION["project_id"], $t['fk_task_id']], $tasks_to_add)) {
                    $task->setTaskToDo($_SESSION["project_id"], $t['fk_task_id']);
                    array_push($tasks_to_add, [$_SESSION["project_id"], $t['fk_task_id']]);
                }
            }
        }
    }
    echo json_encode("OK");
}
