<?php
    session_start();
    require_once '../dbconfig.php';

    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);
    if($_SESSION["username"]) {
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);
        $username = mysqli_real_escape_string($conn, $_SESSION["username"]);
        $query = "SELECT * FROM PRENOTAZIONI WHERE cliente = '$username'";
        $res = mysqli_query($conn, $query);
        if($res) {
            $result = [];
            while($row = mysqli_fetch_assoc($res)){
                $result[]=$row;
            }
            echo json_encode($result);
        }
    }
