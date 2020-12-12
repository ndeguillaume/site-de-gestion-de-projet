<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Issue.php";

    $database = new Database();
    $db = $database->getConnection();

    $args = explode("&", $_SERVER['QUERY_STRING']);


    if (count($args) == 2) {
        $sprint_id = explode("&", $_SERVER['QUERY_STRING'])[1];
        $sprint_id = explode("sprint_id=", $sprint_id)[1];
        $id = explode("&", $_SERVER['QUERY_STRING'])[0];
        $id = explode("id=", $id)[1];
        $issue = new Issue($db);
        $issue->updateSprint($_SESSION["project_id"], $sprint_id, $id);
    } elseif (count($args) == 5) {
        $id = explode("id=", $args[0])[1];
        $title = explode("title=", $args[1])[1];
        $description = explode("description=", $args[2])[1];
        if ($description == "") {
            $description = null;
        }
        $cost = explode("cost=", $args[3])[1];
        if ($cost == "") {
            $cost = null;
        }
        $priority = explode("priority=", $args[4])[1];
        if ($priority == "") {
            $priority = null;
        }

        $issue = new Issue($db);
        $issue->update($_SESSION["project_id"], $id, $title, $description, $cost, $priority);
    }
    echo json_encode("OK");
}
