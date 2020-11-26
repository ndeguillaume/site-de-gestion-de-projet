<?php

if (
    (function_exists('session_status')
    && session_status() !== PHP_SESSION_ACTIVE) || !session_id()
) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once "../../../includes/Style.php";
    require_once "../../../includes/Scripts.php";
    ?>
    <script type="text/javascript" src="../controllers/TasksDragAndDrop.js" defer></script>
    <title>Kanban</title>
</head>
<body>
    <?php
    require_once "../../../data/mysql/includes/Database.php";
    require_once "../../../includes/Navbar.php";
    require_once "../data/Tasks.php";
    require_once "../../../includes/Util.php";
    $database = new Database();
    $db = $database->getConnection();
    ?>

    <div class="container kanban">
        <div class="headers">
            <div class="text-center column-header" id="todo-column-header">
                TODO
            </div>
            <div class="text-center column-header" id="inprogress-column-header">
                IN PROGRESS
            </div>
            <div class="text-center column-header" id="done-column-header">
                DONE
            </div>
        </div>
        <div class="body">
            <div class="column-body" id="todo-column-body">
                <div class="kanban-sortable">
                    <?php
                    $tasks = new Tasks($db);
                    foreach ($tasks->getTasksToDo() as $tasks_todo) {
                        echo "<div class='ui-state-default' id='task-" . $tasks_todo[1] . "'>";
                        echo "<div id='draggable-" . $tasks_todo[1] . "'>";
                        echo "<span class='task-info'> #" . $tasks_todo[1] . " " . $tasks_todo[2] . " </span>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <div class="column-body" id="inprogress-column-body">
                <div class="kanban-sortable">
                <?php
                    $tasks = new Tasks($db);
                foreach ($tasks->getTasksInProgress() as $tasks_inprogress) {
                    echo "<div class='ui-state-default' id='task-" . $tasks_inprogress[1] . "'>";
                    echo "<div id='draggable-" . $tasks_inprogress[1] . "'>";
                    echo "<span class='task-info'> #" . $tasks_inprogress[1] . " " . $tasks_inprogress[2] . " </span>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
                </div>
            </div>
            <div class="column-body" id=done-column-body>
                <div class="kanban-sortable">
                <?php
                    $tasks = new Tasks($db);
                foreach ($tasks->getTasksDone() as $tasks_done) {
                    echo "<div class='ui-state-default' id='task-" . $tasks_done[1] . "'>";
                    echo "<div id='draggable-" . $tasks_done[1] . "'>";
                    echo "<span class='task-info'> #" . $tasks_done[1] . " " . $tasks_done[2] . " </span>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
                </div>
            </div>
        </div>
    </div>     
</body>
</html>