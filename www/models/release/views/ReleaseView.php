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
    <script type="text/javascript" src="../controllers/CreateRelease.js" defer></script>
    <title>Release</title>
</head>

<body>
    <?php
    require_once "../../../includes/Navbar.php";
    require_once "../../../data/mysql/includes/Database.php";
    require_once "../../../includes/Util.php";
    require_once "../data/Release.php";
    include_once "../../documentation/data/UserDocumentation.php";
    include_once "../../documentation/data/UserDocumentationHistory.php";
    include_once "../../documentation/data/InstallDocumentation.php";
    include_once "../../documentation/data/InstallDocumentationHistory.php";
    ?>


    <div class="container-fluid">
        <div class="row">
            <div class="backlog-content col-12">
                <?php

                $database = new Database();
                $db       = $database->getConnection();
                $release = new Release($db);
                echo "<div>";
                echo "<div class='sprint' id='release'>";
                echo "<div class='sprint-header'><div class='sprint-title'></i> Releases</div></div>";
                echo "<div>";
                echo "<div class='sprint-header'>";
                echo "<table class='release-table'>
                <tbody>
                    <tr>
                        <th class='release-column'>  Version </th> 
                        <th class='release-column'> Date </th> 
                        <th class='release-column'>  Issues réalisées </th> 
                        <th class='release-column'>  Archive </th>
                        <th class='release-column'>  Documentation utilisateur</th> 
                        <th class='release-column'>  Documentation d'installation</th> 
                    </tr>"; 


                $all_releases = $release->getAllReleases();

                if ($all_releases !== false) {
                    foreach ($all_releases->fetchAll() as $row) {
                        echo "<tr><td>" . $row['major'] . '.' . $row['minor'] . '.' . $row['patch'] . "</td>";
                        echo "<td>" . $row['date_release'] . "</td>";
                        $finished_issues = $release->getFinishedIssues($_SESSION['project_id'], $row['id']);
                        echo "<td>";
                        if ($finished_issues !== false) {
                            foreach ($finished_issues->fetchAll() as $line) {
                                echo $line['finished_issue_id'] . ' ' ;
                            }
                        }
                        echo "</td>";
                        echo "<td class='download-col'><a href='".$row['path_release']."'></span><button type='button' class='btn btn-secondary'><i class='fas fa-download'></i>Télécharger</button></a>";
                        $user_documentation = new UserDocumentationHistory($db);
                        $install_documentation = new InstallDocumentationHistory($db);
                        $user_path = $user_documentation->getSpecificPath($row['fk_user_documentation_id'])[0];
                        $install_path = $install_documentation->getSpecificPath($row['fk_install_documentation_id'])[0];
                        echo "<td class='download-col'><a href='". "../../documentation/files".explode("files",$user_path)[1] ."'></span><button type='button' class='btn btn-secondary'><i class='fas fa-download'></i>Télécharger</button></a>";
                        echo "<td class='download-col'><a href='". "../../documentation/files".explode("files",$install_path)[1] ."'></span><button type='button' class='btn btn-secondary'><i class='fas fa-download'></i>Télécharger</button></a>";

                        echo "</tr>";
                    }
                }
                
                echo "</tbody></table>";
                echo "</div>";
                echo "<div class='sprint-footer'>";
                echo "<div class='add-task-button'>";
                echo "<div class='add-release-button'>
    <div class='add-release'>+ Ajouter une release</div>
    </div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                ?>

            </div>
        </div>
    </div>
    </div>
</body>

</html>