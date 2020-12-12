<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Test.php";
    include_once "../data/TestHistory.php";

    $database = new Database();
    $db = $database->getConnection();

    $test = new Test($db);
    $test->delete($_SESSION["project_id"], explode("id=", $_SERVER['QUERY_STRING'])[1]);
    $test_history = new TestHistory($db);
    $test_history->delete(explode("id=", $_SERVER['QUERY_STRING'])[1]);
    echo json_encode("OK");
}

?>