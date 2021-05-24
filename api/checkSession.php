<?php

session_start();

$response = ['ok' => true];
if (!isset($_SESSION["username"])) {
    $response["ok"] = false;
}

echo json_encode($response);
