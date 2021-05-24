<head>
    <script src="./scripts/hotels.js"></script>
</head>
<?php
session_start();
require_once 'dbconfig.php';

include 'header.php';
$hotel;
if ($_GET["id"]) {
    // TODO STORICO
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);

    $id = mysqli_real_escape_string($conn, $_GET["id"]);

    $query = "SELECT * FROM HOTELS WHERE id = $id";
    $res = mysqli_query($conn, $query);
    if ($res) {
        $hotel = mysqli_fetch_assoc($res);
    }
} else {
    header("Location: home.php");
}
?>

<div class="column">
    <div class="card">
        <div class="image">
            <img src=<?php echo $hotel["image"] ?> alt="" class="fullImage">
        </div>
        <div class="text">
            <h3><?php echo $hotel["denomination"] ?> </h3>
            <p><?php echo $hotel["description"] ?> </p>
        </div>
        <div>
            <button id="back" onclick="goBack()">Torna indietro</button>
            <button onclick="seeDates()">Prenota</button>
        </div>
        <div id="dates"></div>
        <div id="result"></div>
    </div>
</div>

<?php
include 'footer.php';
