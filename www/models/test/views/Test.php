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
    <script type="text/javascript" src="../controllers/DeleteTest.js" defer></script>
    <script type="text/javascript" src="../controllers/copyAPIRequest.js" defer></script>
    <script type="text/javascript" src="../controllers/onTestHistoryClicked.js" defer></script>
    <title>Test</title>
</head>

<body>
    <?php
    require_once "../../../includes/Navbar.php";
    require_once "../../../data/mysql/includes/Database.php";
    require_once "../../../includes/Util.php";
    require_once "../data/Scenarios.php";
    require_once "../data/Tests.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="test-content col-12">
                <?php
                $database = new Database();
                $db       = $database->getConnection();


                $tests           = new Tests($db);
                $testsTab        = $tests->getTests();
                if (empty($testsTab)) {
                    $testsTab = array();
                }
                $passingTestsTab = $tests->getPassingTests();
                if (empty($passingTestsTab)) {
                    $passingTestsTab = array();
                }

                echo "<div>";
                echo "<div class='sprint'";
                echo "<div class='sprint-header'>
        <div class='sprint-header'>
            <div class='sprint-title'>
                Liste des tests 
            </div>
            <div class='nb-tests-passed'>
                Test(s) passé(s) : " . sizeof($passingTestsTab) . "/" . sizeof($testsTab) . "
            </div>
        </div>";
                echo "<div class='sprint-content'> 
          <ul class='test-list'>";
                if ($testsTab != "") {
                    foreach ($testsTab as $test) {
                        echo "<li class='ui-state-default' id='test-" . $test['id'] . "'>";
                        if (empty($test['fk_issue_id'])) {
                            echo "<i class='fas fa-times delete-test'></i><span class='test-id'>" . $test['id'] . " unitaire</span>";
                        } else {
                            echo "<i class='fas fa-times delete-test'></i><span class='test-id'>" . $test['id'] . " E2E</span>";
                        }
                        echo "<span class='test-title'> " . $test['title'] . "</span>";
                        echo "<i class='fas fa-question-circle help-php'></i><button class='btn btn-secondary API-php-request'><i class='far fa-clipboard'></i>API PHP</button>";
                        echo "<i class='fas fa-question-circle help-js'></i><button class='btn btn-secondary API-js-request'><i class='far fa-clipboard'></i>API JS</button>";
                        if (empty($test['last_test_res'])) {
                            echo '<button class="btn btn-secondary test-history" disabled><i class="fas fa-history"></i>Historique</button><div class="test-ico-wrapper">
                <i class="fas fa-circle"></i>
                </div>';
                        } else {
                            echo '<button class="btn btn-secondary test-history"><i class="fas fa-history"></i>Historique</button>';
                            if ($test['last_test_res'] == "true") {
                                echo '<div class="passed-test-ico-wrapper">
                        <i class="fas fa-circle passed"></i>
                        </div>';
                            } else {
                                echo '<div class="not-passed-test-ico-wrapper">
                        <i class="fas fa-circle not-passed"></i>
                        </div>';
                            }
                        }
                        echo "</li>";
                    }
                }
                echo "</ul>";
                echo "</div>";
                echo "</div>";

                ?>

            </div>
        </div>
    </div>
</body>

</html>