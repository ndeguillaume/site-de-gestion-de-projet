<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Release.php";
    include_once "../../issue/data/Issues.php";
    include_once "../../issue/data/Issue.php";

    include_once "../../sprint/data/Sprints.php";
    include_once "../../task/data/Tasks.php";

    include_once "../../documentation/data/InstallDocumentation.php";
    include_once "../../documentation/data/UserDocumentation.php";

    $database = new Database();
    $db = $database->getConnection();
    $release = new Release($db);
    $issues = new Issues($db);
    $issue = new Issue($db);
    
    $tasks = new Tasks($db);
    $sprints = new Sprints($db);


    $last_release = $release->getLastRelease();
    $last_version_major = "";
    $last_version_minor = "";
    $last_version_patch = "";
    if ($last_release !== false && $last_release !== null) {
        foreach ($last_release as $row) {
            $last_version_major = $row['major'];
            $last_version_minor = $row['minor'];
            $last_version_patch = $row['patch'];
        }
    }
    $active_sprint_issues = "";
    $active_sprint = $sprints->getActiveSprint();
    if (!empty($active_sprint)) {
        $active_sprint_id = $active_sprint['id'];
        foreach ($issues->getIssuesBySprint($active_sprint_id) as $row) {
            $is_finished = true;
            foreach($issue->getRelatedTasks($row["id"]) as $related_task) {
                foreach($tasks->getTasksTodo() as $task_todo) {
                    if($related_task["fk_task_id"] == $task_todo["fk_task_id"]) {
                        $is_finished = false;
                    }
                }
                foreach($tasks->getTasksInProgress() as $task_inprogress) {
                    if($related_task["fk_task_id"] == $task_inprogress["fk_task_id"]) {
                        $is_finished = false;
                    }
                }
            }
            if($is_finished == true)
                $active_sprint_issues .= $row["id"] . ',';
        }
        $active_sprint_issues = mb_substr($active_sprint_issues, 0, -1);
    }

    echo json_encode(
        array(
            $last_version_major,
            $last_version_minor,
            $last_version_patch,
            $active_sprint_issues
        )
    );
}
