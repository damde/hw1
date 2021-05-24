<?php
session_start();

if (!$_SESSION["username"]) {
    header("Location: login.php");
}
?>

<head>
    <script src="./scripts/reservationList.js" defer></script>
</head>

<body>


    <?php
    include('./header.php');
    ?>

    <div class="column">
        <table>
            <thead>
                <tr>
                    <th>Data prenotazione</th>
                    <th>Data inizio</th>
                    <th>Data fine</th>
                    <th>Prezzo</th>
                </tr>
            </thead>
            <tbody id="res">
            </tbody>
        </table>
    </div>

    <?php
    include("./footer.php");
    ?>
</body>