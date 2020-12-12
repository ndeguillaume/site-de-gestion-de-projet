<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Task.php";
    include_once "../data/Tasks.php";
    include_once "../../issue/data/Issues.php";
    include_once "../../sprint/data/Sprints.php";




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
    } else if (count($args) === 7) {
        $task = new Task($db);
        $tasks = new Tasks($db);
        $issues = new Issues($db);
        $sprints = new Sprints($db);

        $task_id = urldecode(explode("=", $args[0])[1]);
        $task_title = urldecode(explode("=", $args[1])[1]);
        $task_description = urldecode(explode("=", $args[2])[1]);
        $task_dod = urldecode(explode("=", $args[3])[1]);
        $task_duration = urldecode(explode("=", $args[4])[1]);
        $task_parent = explode("=", $args[5])[1];
        $task_related_issues = explode("=", $args[6])[1];

        $task->read($task_id);
        $active_sprint_id = $sprints->getActiveSprint()['id'];

        $active_sprint_issues = "";
        foreach ($issues->getIssuesBySprint($active_sprint_id) as $row) {
            $active_sprint_issues .= $row["id"].',';
        }
        $active_sprint_issues_id = explode(",", mb_substr($active_sprint_issues,0,-1)); 


        $isInKanban = false;
        foreach($tasks->getTasksToDo()->fetchAll() as $row){
            if($row["fk_task_id"]  === $task_id){
                $isInKanban = true;
            }
        }
        foreach($tasks->getTasksInProgress()->fetchAll() as $row){
            if($row["fk_task_id"]  === $task_id){
                $isInKanban = true;
            }
        }
        foreach($tasks->getTasksDone()->fetchAll() as $row){
            if($row["fk_task_id"] === $task_id){
                $isInKanban = true;
            }
        }

        $task->deleteIssueDependency($_SESSION['project_id'], $task_id);
        $task->deleteParentTask($_SESSION['project_id'], $task_id);

        $task_parent_args = explode(",", $task_parent);
        foreach ($task_parent_args as $args) {
            $task->addParentTask($_SESSION['project_id'], $task_id, $args);
        }

        $task_related_issues_args = explode(",", $task_related_issues);
        foreach ($task_related_issues_args as $args) {
            $task->addIssueDependency($_SESSION['project_id'], $task_id, $args);
            foreach($active_sprint_issues_id as $active_issue){
                if($args === $active_issue && !$isInKanban){
                    $task->setTaskToDo($_SESSION["project_id"], $task_id);
                    $isInKanban = true;
                }
            }
        }

        if (!$task->update($task_id, $task_title, $task_description, $task_dod, $task_duration)) {
            echo json_encode("KO");
        }
    }
    echo json_encode("OK");
}
