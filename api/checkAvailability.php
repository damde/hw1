<?php

session_start();

require_once '../dbconfig.php';

if (isset($_GET["startDate"]) && isset($_GET["endDate"]) && isset($_GET["hotel"])) {
    //echo $_GET["hotel"];
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);
    $startDate = mysqli_real_escape_string($conn, $_GET["startDate"]);
    $endDate = mysqli_real_escape_string($conn, $_GET["endDate"]);
    $hotel = mysqli_real_escape_string($conn, $_GET["hotel"]);

    $query = "SELECT * FROM STANZE WHERE hotel = $hotel";
    $result = [];
    $res = mysqli_query($conn, $query);

    if ($res) {

        while ($row = mysqli_fetch_assoc($res)) {
            $idStanza = $row["IDStanza"];
            $query = "SELECT * 
                    FROM PRENOTAZIONI
                    JOIN PRENOTA ON PRENOTA.prenotazione = PRENOTAZIONI.IDPrenotazione
                    WHERE PRENOTA.stanza = $idStanza AND 
                    $startDate BETWEEN PRENOTAZIONI.dataInizio AND PRENOTAZIONI.dataFine OR 
                    $endDate BETWEEN PRENOTAZIONI.dataInizio AND PRENOTAZIONI.dataFine";
            $resT = mysqli_query($conn, $query);
            if (mysqli_num_rows($resT) == 0) {
                $result[] = $row;
            }
        }
        echo json_encode($result);
    } else {
    }
}

/*
SELECT * 
                    FROM PRENOTAZIONI
                    JOIN PRENOTA ON PRENOTA.prenotazione = PRENOTAZIONI.IDPrenotazione
                    WHERE PRENOTA.stanza = 1 AND 
                    2021-05-19 BETWEEN PRENOTAZIONI.dataInizio AND PRENOTAZIONI.dataFine OR 
                    2021-05-20 BETWEEN PRENOTAZIONI.dataInizio AND PRENOTAZIONI.dataFine;
*/