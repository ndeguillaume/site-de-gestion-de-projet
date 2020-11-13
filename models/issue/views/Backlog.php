<?php
if ((function_exists('session_status') 
&& session_status() !== PHP_SESSION_ACTIVE) || !session_id()) {
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
    <script type="text/javascript" src="../controllers/CreateIssue.js" defer></script>
    <script type="text/javascript" src="../controllers/DeleteIssue.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/CreateSprint.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/DeleteSprint.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/EndSprint.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/StartSprint.js" defer></script>
    <script type="text/javascript" src="../controllers/IssuesDragAndDrop.js" defer ></script>
    <script type="text/javascript" src="../controllers/OnIssueClicked.js" defer></script>
    <title>Backlog</title>
</head>
<body>
    <?php
    include_once("../../../includes/Navbar.php"); 
    ?>

<div class="container-xl d-table">
<div class="backlog-content">
    <?php 
        include_once("../data/Issues.php");
        include_once("../../sprint/data/Sprints.php");
        include_once("../../sprint/data/Sprint.php");
        include_once("../../../data/mysql/includes/Database.php");
        include_once("../../../includes/Util.php"); 
        $_SESSION["project_id"] = "1";
        $database= new Database();
        $db = $database->getConnection();
       
        $sprints = new Sprints($db);
        $next_sprint_to_launch = true;
        foreach  ($sprints->getSprints() as $sprint) {
            $sprintObj = new Sprint($db);
            $is_sprint_finished = $sprintObj->isFinishedSprint($sprint['id']);
            if($is_sprint_finished) {
                echo "<div class='ended-sprint sprint' id='sprint-". $sprint['id'] . "'>";
                echo "<div class='sprint-header'><div class='sprint-title'>".$sprint['title']."</div>";
            }
            else {
                echo "<div class='sprint' id='sprint-". $sprint['id'] . "'>";
                echo "<div class='sprint-header'><div class='sprint-title'><i class='fas fa-times delete-sprint'></i>".$sprint['title']."</div>";
            }
            if(!$sprint['begin_date']=="") {
               echo "<div class='sprint-date'>".enhanceDate($sprint['begin_date'])." à ". enhanceDate($sprint['end_date'])."</div>";
            }
            $active_sprint = $sprints->getActiveSprint()['id'];
            if($active_sprint==null && !$is_sprint_finished && $next_sprint_to_launch) 
            {
                echo "<button type='button' class='btn btn-success start-sprint'>Lancer le sprint</button>";
                $next_sprint_to_launch = false;
            }
            else if($active_sprint == $sprint['id'])
            {
                echo "<button type='button' class='btn btn-danger end-sprint'>Terminer le sprint</button>";
            }

            echo "</div>";  
            echo "<div class='sprint-content sortable'>";  
            $issues = new Issues($db);
            $nb_of_issues = 0;
            foreach ($issues->getIssuesBySprint($sprint['id']) as $sprint_issue) {
                $nb_of_issues++;
                echo "<div class='issue-". $sprint_issue['id'] ."' id='draggable". $sprint_issue['id'] . "'>";
                if ($is_sprint_finished) {
                    echo "<span class='issue-id'>".$sprint_issue['id']."</span>";
                } 
                else {
                echo "<i class='fas fa-times delete-issue'></i><span class='issue-id'>".$sprint_issue['id']."</span>";
                }
                echo "<span class='issue-title'> ".$sprint_issue['title']."</span>";
                echo "</div>";
            }
            echo "</div>";
            echo "<div class='sprint-footer'>
                    <div class='sprint-count'>
                        <span>".$nb_of_issues."</span> 
                        issues
                    </div>";
             if (!$is_sprint_finished)
             echo   "<div class='add-issue-button'>
                        <button type='button' class='btn btn-primary add-issue'>Ajouter une issue</button>
                    </div>";
            echo    "</div>";
            echo "</div>";
        }

        echo "<div class='sprint'>";
        $issues = new Issues($db);
        $nb_of_issues = 0;
        echo "<div class='sprint-header'><div class='sprint-title'>Backlog</div><div class='add-sprint-button'>
        <button type='button' class='btn btn-secondary add-sprint'>Ajouter un sprint</button>
    </div></div>";
    echo "<div class='sprint-content sortable'>";  
        foreach  ($issues->getBacklogIssues() as $backlog_issue) {
            $nb_of_issues++;
            echo "<div class='issue-". $backlog_issue['id'] ."' id='draggable". $backlog_issue['id'] . "'>";
            echo "<i class='fas fa-times delete-issue'></i><span class='issue-id'>".$backlog_issue['id']."</span>";
            echo "<span class='issue-title'> ".$backlog_issue['title']."</span>";
            echo "</div>";
        }
        echo "</div>";
        echo "<div class='sprint-footer'>
                <div class='sprint-count'>
                    <span>".$nb_of_issues."</span> 
                    issues
                </div> 
                <div class='add-issue-button'>
                    <button type='button' class='btn btn-primary add-issue'>Ajouter une issue</button>
                </div>
            </div>";
        echo "</div>";

    ?>
        </div>
        <?php 
            include_once("../includes/IssueInformation.php");
        ?>
    </div>
</body>
</html>