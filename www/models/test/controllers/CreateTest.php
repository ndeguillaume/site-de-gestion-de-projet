<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Test.php";

    $database = new Database();
    $db = $database->getConnection();

    $test = new Test($db);

    if ($_POST["fk_task_id"] != "NULL") {
        echo json_encode($test->createUnitaryTest($_POST["title"],$_POST["fk_task_id"], $_POST["fk_test_scenario_id"]));
    } 
    else {
        echo json_encode($test->createE2ETest($_POST["title"],$_POST["fk_issue_id"], $_POST["fk_test_scenario_id"]));
    }
}
