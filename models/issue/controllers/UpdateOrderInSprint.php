<?php

if (
    (function_exists('session_status')
    && session_status() !== PHP_SESSION_ACTIVE) || !session_id()
) {
    session_start();
}
?>
<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Issue.php";

    $database = new Database();
    $db = $database->getConnection();

    $args = explode("&", $_SERVER['QUERY_STRING']);

    $order_in_sprint = explode("&", $_SERVER['QUERY_STRING'])[1];
    $order_in_sprint = explode("order_in_sprint=", $order_in_sprint)[1];
    $id = explode("&", $_SERVER['QUERY_STRING'])[0];
    $id = explode("id=", $id)[1];
    $issue = new Issue($db);
    $issue->updateOrderInSprint($_SESSION["project_id"], $order_in_sprint, $id);
    
    echo json_encode("OK");
}
