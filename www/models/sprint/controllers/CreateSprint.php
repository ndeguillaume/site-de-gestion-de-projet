<?php

if (
    (function_exists('session_status')
    && session_status() !== PHP_SESSION_ACTIVE) || !session_id()
) {
    session_start();
}
?>
<?php
// Headers requis

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once "../../../data/mysql/includes/Database.php";
    include_once "../data/Sprint.php";

    $database = new Database();
    $db = $database->getConnection();

    $s = new Sprint($db);

    $fetch = $s->getLastSprintName()->fetch();

    $lastSprintTitle = $fetch["title"];

    $lastChar = mb_substr($lastSprintTitle, -1);

    $newSprintTitle = "";

    if (is_numeric($lastChar)) {
        $newSprintTitle = mb_substr($lastSprintTitle, 0, strlen($lastSprintTitle) - 1);
        (int) $lastChar++;
        $newSprintTitle .= $lastChar;
    } else {
        $newSprintTitle = $lastSprintTitle . '2';
    }

    $s->create($newSprintTitle);
    

    echo json_encode("OK");
}
