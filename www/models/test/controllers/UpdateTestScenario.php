<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once "../../../includes/Session.php";

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Scenario.php";

    $database = new Database();
    $db = $database->getConnection();

    $args = explode("&", $_SERVER['QUERY_STRING']);
        $scenario_id = explode("&", $_SERVER['QUERY_STRING'])[0];
        $scenario_id = explode("id=", $scenario_id)[1];
        $title = explode("&", $_SERVER['QUERY_STRING'])[1];
        $title = explode("title=", $title)[1];     
        $description = explode("&", $_SERVER['QUERY_STRING'])[2];
        $description = explode("description=", $description)[1];     
        if ($description == "") $description = NULL;
        $scenario = new Scenario($db);
        $scenario->update($_SESSION["project_id"], $scenario_id, $title, $description);
        
    echo json_encode("OK");
}
