<?php
session_start();
require_once '../dbconfig.php';

$err = "";
$response = ['ok' => true, 'msg' => ""];
if (isset($_GET["startDate"]) && isset($_GET["endDate"]) && isset($_GET["room"])) {
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);
    mysqli_query($conn, "SET FOREIGN_KEY_CHECKS=0;");
    $startDate = mysqli_real_escape_string($conn, $_GET["startDate"]);
    $endDate = mysqli_real_escape_string($conn, $_GET["endDate"]);
    $idStanza = mysqli_real_escape_string($conn, $_GET["room"]);
    
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);

    if($username){
        $query = "SELECT * 
            FROM PRENOTAZIONI
            JOIN PRENOTA ON PRENOTA.prenotazione = PRENOTAZIONI.IDPrenotazione
            WHERE PRENOTA.stanza = $idStanza AND 
            $startDate BETWEEN PRENOTAZIONI.dataInizio AND PRENOTAZIONI.dataFine OR 
            $endDate BETWEEN PRENOTAZIONI.dataInizio AND PRENOTAZIONI.dataFine";
        
        $resT = mysqli_query($conn, $query);
        if ($resT && mysqli_num_rows($resT) == 0) {
            $query = "SELECT * FROM STANZE WHERE IDStanza = $idStanza";
            $resR = mysqli_query($conn, $query);
            $prezzoT = 0;
            if($resR) {
                $r  = mysqli_fetch_assoc($resR);
                $prezzoT = $r["prezzo"];
            }
            $query = "INSERT INTO PRENOTAZIONI(dataInizio, dataFine, cliente, prezzoTotale)
                VALUES (STR_TO_DATE('$startDate', '%Y-%m-%d'), STR_TO_DATE('$endDate', '%Y-%m-%d'), '$username', $prezzoT);";
            
            $res = mysqli_query($conn, $query);
            if($res) {
                $id = mysqli_insert_id($conn);
                $query = "INSERT INTO PRENOTA(prenotazione, stanza)
                VALUES ($id, $idStanza);";
                $res = mysqli_query($conn, $query);
            } else {
                $err = "A Stanza giá prenotata";    
            }
        } else {
            $err = "B Stanza giá prenotata";
        }
    } else {
        $err = "Errore sessione";
    }
}
if($err != "") {
    $response["ok"] = false;
    $response["msg"] = $err;
}

echo json_encode($response);
