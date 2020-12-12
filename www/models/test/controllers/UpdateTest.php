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
    include_once "../data/TestHistory.php";

    $database = new Database();
    $db = $database->getConnection();
    $data = json_decode(file_get_contents('php://input'), true);
    $test = new Test($db);
    $test->update($data['id'], $data['result']);

    $test_history = new TestHistory($db);
    $test_history->create($data['id'], $data['result']);
    echo json_encode($data);
}
