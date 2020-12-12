<?php
    require_once "../../../includes/Session.php";
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
    <script type="text/javascript" src="../controllers/CreateIssue.js" defer></script>
    <script type="text/javascript" src="../controllers/DeleteIssue.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/CreateSprint.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/DeleteSprint.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/EndSprint.js" defer></script>
    <script type="text/javascript" src="../../sprint/controllers/StartSprint.js" defer></script>
    <script type="text/javascript" src="../controllers/IssuesDragAndDrop.js" defer></script>
    <script type="text/javascript" src="../controllers/OnIssueClicked.js" defer></script>
    <script type="text/javascript" src="../includes/Hoverbar.js" defer></script>
    <script type="text/javascript" src="../includes/SprintDropdownButton.js" defer></script>
    <title>Backlog</title>
</head>
<body>
    <?php
    require_once "../../../includes/Navbar.php";
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="backlog-content col-12">
                <?php
                require_once "../data/Issues.php";
                require_once "../../sprint/data/Sprints.php";
                require_once "../../sprint/data/Sprint.php";
                require_once "../../../data/mysql/includes/Database.php";
                require_once "../../../includes/Util.php";
                $database = new Database();
                $db = $database->getConnection();

                $sprints = new Sprints($db);
                $next_sprint_to_launch = true;
                foreach ($sprints->getSprints() as $sprint) {
                    $sprintObj = new Sprint($db);
                    $is_sprint_finished = $sprintObj->isFinishedSprint($sprint['id']);
                    $issues = new Issues($db);
                    $nb_of_issues = 0;
                    $nb_of_issues = count($issues->getIssuesBySprint($sprint['id']));
                    if ($is_sprint_finished) {
                        echo "<div class='ended-sprint sprint' id='sprint-" . $sprint['id'] . "'>";
                        echo "<div class='sprint-header'>
                    <span>
                        <div class='sprint-title'>" . $sprint['title'] . "</div> - " . $nb_of_issues . " issues
                    </span>";
                    } else {
                        echo "<div class='sprint' id='sprint-" . $sprint['id'] . "'>";
                        echo "<div class='sprint-header'>
                            <span>
                                <div class='sprint-title'>
                                    <i class='fas fa-times delete-sprint'></i>" . $sprint['title'] .
                            "</div>
                                    - <span class = 'nb-of-issues'>" . $nb_of_issues . "</span> issues
                            </span>";
                    }
                    if (!$sprint['begin_date'] == "") {
                        echo "<div class='sprint-date'>Du " . enhanceDate($sprint['begin_date']) . " au " . enhanceDate($sprint['end_date']) . "</div>";
                    }
                    $active_sprint = $sprints->getActiveSprint()['id'];
                    if ($active_sprint == null && !$is_sprint_finished && $next_sprint_to_launch) {
                        echo "<div><button type='button' class='btn btn-success start-sprint'>Lancer le sprint</button></div>";
                        $next_sprint_to_launch = false;
                    } elseif ($active_sprint == $sprint['id']) {
                        echo "<div><button type='button' class='btn btn-danger end-sprint'>Terminer le sprint</button></div>";
                    }
                    echo "<div class='sprint-dropdown-wrapper'><i class='fas fa-chevron-down'></i></div>";
                    echo "</div>";
                    echo "<div class='sprint-content' id='sprint-" . $sprint['id'] . "-content'>
                    <ul class='connectedSortable issues-list'>";
                    foreach ($issues->getIssuesBySprint($sprint['id']) as $sprint_issue) {
                        echo "<li class='ui-state-default' id='issue-" . $sprint_issue['id'] . "'>";
                        if ($is_sprint_finished) {
                            echo "<span class='issue-id'>" . $sprint_issue['id'] . "</span>";
                        } else {
                            echo "<i class='fas fa-times delete-issue'></i><span class='issue-id'>" . $sprint_issue['id'] . "</span>";
                        }
                        echo "<span class='issue-title'>" . $sprint_issue['title'] . "</span>";
                        switch ($sprint_issue["priority"]) {
                            case "highest":
                                echo "<i class='fas fa-angle-double-up priority-icon'></i>";
                                break;
                            case "high":
                                echo "<i class='fas fa-angle-up priority-icon'></i>";
                                break;
                            case "medium":
                                echo "<i class='fas fa-arrows-alt-h priority-icon'></i>";
                                break;
                            case "low":
                                echo "<i class='fas fa-angle-down priority-icon'></i>";
                                break;
                            case "lowest":
                                echo "<i class='fas fa-angle-double-down priority-icon'></i>";
                                break;
                            default:
                                echo "<i class='fas fa-question priority-icon'></i>";
                        }
                        echo "</li>";
                    }
                    echo "</ul></div>";
                    echo "<div class='sprint-footer'>";
                    if (!$is_sprint_finished) {
                        echo   "<div class='add-issue-button'>
                    <div class='add-issue'>+ Ajouter une issue</div>
                    </div>";
                    }
                    echo    "</div>";
                    echo "</div>";
                }

                echo "<div class='sprint' id='backlog'>";
                $issues = new Issues($db);
                $nb_of_issues = count($issues->getBacklogIssues());
                echo "<div class='sprint-header'>
                <span>
                    <div class='sprint-title'>Backlog</div> 
                    - <span class='nb-of-issues'>" . $nb_of_issues . "</span> issues
                </span>
                <div class='add-sprint-button'>
                    <button type='button' class='btn btn-secondary add-sprint'>Ajouter un sprint</button>
                </div>
                <div class='sprint-dropdown-wrapper'><i class='fas fa-chevron-down'></i></div>
             </div>";
                echo "<div class='sprint-content' id='backlog-sortable'> <ul class='connectedSortable'>";
                foreach ($issues->getBacklogIssues() as $backlog_issue) {
                    echo "<li class='ui-state-default' id='issue-" . $backlog_issue['id'] . "'>";
                    echo "<i class='fas fa-times delete-issue'></i><span class='issue-id'>" . $backlog_issue['id'] . "</span>";
                    echo "<span class='issue-title'>" . $backlog_issue['title'] . "</span>";
                    switch ($backlog_issue["priority"]) {
                        case "highest":
                            echo "<i class='fas fa-angle-double-up priority-icon'></i>";
                            break;
                        case "high":
                            echo "<i class='fas fa-angle-up priority-icon'></i>";
                            break;
                        case "medium":
                            echo "<i class='fas fa-arrows-alt-h priority-icon'></i>";
                            break;
                        case "low":
                            echo "<i class='fas fa-angle-down priority-icon'></i>";
                            break;
                        case "lowest":
                            echo "<i class='fas fa-angle-double-down priority-icon'></i>";
                            break;
                        default:
                            echo "<i class='fas fa-question priority-icon'></i>";
                    }
                    echo "</li>";
                }
                echo "</ul></div>";
                echo "<div class='sprint-footer'>
                <div class='add-issue-button'>
                    <div class='add-issue'>+ Ajouter une issue</div>
                </div>
            </div>";
                echo "</div>";

                ?>
            </div>
            <?php
            require_once "../includes/IssueInformation.php";
            ?>
        </div>
    </div>
</body>
</html>