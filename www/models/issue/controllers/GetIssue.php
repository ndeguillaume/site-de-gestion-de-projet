<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Issue.php";

    $database = new Database();
    $db = $database->getConnection();

    $issue = new Issue($db);
    $issue->read($_SESSION["project_id"], $_GET["id"]);

    echo json_encode(
        array(
            $issue->id,
            $issue->title,
            $issue->description,
            $issue->cost,
            $issue->priority,
            $issue->sprint_id,
            $issue->order_in_sprint,
        )
    );
}
