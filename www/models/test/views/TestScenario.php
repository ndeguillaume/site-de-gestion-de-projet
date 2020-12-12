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
    <script type="text/javascript" src="../controllers/DeleteTestScenario.js" defer></script>
    <script type="text/javascript" src="../controllers/CreateTestScenario.js" defer></script>
    <script type="text/javascript" src="../controllers/OnTestScenarioClicked.js" defer></script>
    <script type="text/javascript" src="../controllers/OnTestScenarioValidate.js" defer></script>
    <title>Test Scenario</title>
</head>

<body>
    <?php
    require_once "../../../includes/Navbar.php";
    require_once "../../../data/mysql/includes/Database.php";
    require_once "../../../includes/Util.php";
    require_once "../data/Scenarios.php";
    require_once "../data/Test.php";
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="test-scenario-content col-12">
                <?php
                $database = new Database();
                $db       = $database->getConnection();

                $scenarios   = new Scenarios($db);
                $scenarioTab = $scenarios->getScenarios();
                $test        = new Test($db);

                echo "<div>";
                echo "<div class='sprint'";
                echo "<div class='sprint-header'><div class='sprint-title'></i> Liste des scénarios de test </div>";
                echo "<div class='sprint-content'> 
          <ul class='test-scenario-list'>";
                if ($scenarioTab != "") {
                    foreach ($scenarioTab as $scenario) {
                        if (empty($test->isValidated($scenario['id']))) {
                            echo "<li class='ui-state-default' id='test-scenario-" . $scenario['id'] . "'>";
                            echo "<i class='fas fa-times delete-test-scenario'></i><span class='test-scenario-id'>" . $scenario['id'] . "</span>";
                            echo "<span class='task-scenario-title'> " . $scenario['title'] . "</span>";
                            echo '<div class="button-validate-wrapper">
                        <button class="btn btn-success">Valider</button>
                    </div>';
                            echo "</li>";
                        } else {
                            echo "<li class='ui-state-default' id='test-scenario-" . $scenario['id'] . "'>";
                            echo "<i class='fas fa-times disable' title='Un test utilise ce scénario : supprimez le avant de supprimer le scénario'></i><span class='test-scenario-id'>" . $scenario['id'] . "</span>";
                            echo "<span class='task-scenario-title'> " . $scenario['title'] . "</span>";
                        }
                    }
                }
                echo "</ul>";
                echo "</div>";
                echo "<div class='sprint-footer'>";
                echo "<div class='add-test-scenario-button'>
    <div class='add-test-scenario'>+ Ajouter un scénario de test</div>
    </div>";
                echo "</div>";
                echo "</div>";

                ?>

            </div>
        </div>
        <?php
        require_once "../includes/TaskScenarioInformation.php";
        ?>
    </div>
</body>

</html>