<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Sprint.php";
    include_once "../../issue/data/Issues.php";


    $database = new Database();
    $db = $database->getConnection();

    $issues = new Issues($db);
    $issues->removeIssuesFromSprint($_SESSION["project_id"], explode("id=", $_SERVER['QUERY_STRING'])[1]);
    $sprint = new Sprint($db);
    $sprint->delete($_SESSION["project_id"], explode("id=", $_SERVER['QUERY_STRING'])[1]);
    echo json_encode("OK");
}
