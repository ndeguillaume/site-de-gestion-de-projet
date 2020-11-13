<?php
if ((function_exists('session_status') && session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
include_once("../../../includes/Style.php");
include_once("../../../includes/Scripts.php");
?>
    <script type="text/javascript" src="../controllers/DeleteTask.js" defer></script>
    <script type="text/javascript" src="../controllers/CreateTask.js" defer></script>
   <title>TaskList</title>
</head>
<body>
    <?php
include_once("../../../includes/Navbar.php");
include_once("../data/Tasks.php");
include_once("../data/Task.php");
include_once("../../sprint/data/Sprints.php");
include_once("../../../data/mysql/includes/Database.php");
include_once("../../../includes/Util.php"); 
include_once("../../issue/data/Issues.php");
include_once("../../issue/data/Issue.php");
?>

    <div class="container-xl d-table">

    <?php
$database = new Database();
$db       = $database->getConnection();

$sprints       = new Sprints($db);
$active_sprint = $sprints->getActiveSprint();

$issues       = new Issues($db);
$nb_of_issues = 0;
$added_tasks  = array();

echo "<div>";
echo "<div class='sprint' id='sprint-" . $active_sprint['id'] . "'>";
echo "<div class='sprint-header'><div class='sprint-title'></i>" . $active_sprint['title'] . "</div></div>";
echo "<div class='sprint-content'>";
foreach ($issues->getIssuesBySprint($active_sprint['id']) as $sprint_issue) {
    $issue = new Issue($db);
    foreach ($issue->getRelatedTasks($sprint_issue['id']) as $sprint_task) {
        if (!in_array($sprint_task['fk_task_id'], $added_tasks)) {
            array_push($added_tasks, $sprint_task['fk_task_id']);
            $task = new Task($db);
            $task->read($sprint_task["fk_task_id"]);
            
            echo "<div class='task-" . $task->id . "'>";
            echo "<i class='fas fa-times delete-task'></i><span class='issue-id'>" . $task->id . "</span>";
            echo "<span class='issue-title'> " . $task->title . "</span>";
            echo "</div>";
        }
    }
}

$allTasks = new Tasks($db);
$standByTasks = array();
foreach($allTasks->getTasks() as $row) {
    if(!in_array($row['id'], $added_tasks)) {
        array_push($standByTasks, $row['id']);
    } 
}
echo "</div>";
echo "</div>";
echo "<div class='sprint'>";
echo "<div class='sprint-header'>
                <div class='sprint-title'>En attente</div>
                </div>";
echo "<div class='sprint-content'>";
foreach ($standByTasks as $task) {
    $t = new Task($db);
    $t->read($task);
    echo "<div class='task-" . $t->id . "'>";
    echo "<i class='fas fa-times delete-task'></i><span class='issue-id'>" . $t->id . "</span>";
    echo "<span class='issue-title'> " . $t->title . "</span>";
    echo "</div>";
}
echo "</div>";
echo "<div class='sprint-footer'>";
echo "<div class='add-task-button'>";
echo "<button type='button' class='btn btn-secondary add-task'>Ajouter une tâche</button>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
?>

    </div>
</body>
</html>