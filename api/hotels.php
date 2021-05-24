<?php
session_start();

require_once '../dbconfig.php';

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);

if ($_SERVER["REQUEST_METHOD"]  === "GET") {
    $query = "SELECT * FROM HOTELS";
    if (isset($_GET["q"])) {
        $q = mysqli_real_escape_string($conn, $_GET["q"]);
        $query .= " WHERE denomination LIKE  '%$q%'";
        $response = [];
        $res = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_assoc($res)) {
            $response[] = $row;
        }
        echo json_encode($response);
        exit;
    }
    if (isset($_GET["i"]) && $_GET["i"] != -1) {
        $i = mysqli_real_escape_string($conn, $_GET["i"]);
        $query .= " LIMIT $i";
    }
    $response = [];
    $res = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($res)) {
        $response[] = $row;
    }
    echo json_encode($response);
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $response = [
        "ok" => true,
        "msg" => ""
    ];
    // Controllo se la richiesta viene effettuata da un utente "admin"
    if ($_SESSION["role"] === 1) {
        if (
            isset($_POST["denomination"]) &&
            isset($_POST["address"])
        ) {
            // TODO ADD IMAGE FORM
            $denomination = mysqli_real_escape_string($conn, $_POST["denomination"]);
            $address = mysqli_real_escape_string($conn, $_POST["address"]);

            $query = "SELECT * FROM HOTELS WHERE denomination = $denomination";
            $res = mysqli_query($conn, $query);

            if (mysqli_num_rows($res) > 0) {
                $response["ok"] = false;
                $response["msg"] = "Hotel con la stessa denominazione giá presente";
            } else {
                $query = "INSERT INTO HOTELS(denomination, address) VALUES($denomination, $address)";
                $res = mysqli_query($conn, $query);
                $response["msg"] = "Aggiunto con successo";
            }
        } else {
            $response["ok"] = false;
            $response["msg"] = "Body non valido";
        }
    } else {
        http_response_code(401);
        $response["ok"] = false;
        $response["msg"] = "unauthorized";
    }
    echo json_encode($response);
}
