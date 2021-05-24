<?php
session_start();


?>

<head>
    <title>Hotel NUMBERS - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="./style/style.css">
    <meta charset="UTF-8">
</head>

<header>
    <nav class="navbar">
        <div class="center">
            <a href="./home.php">Home</a>
            <a href="./search.php">Ricerca</a>
        </div>
        <div class="right">
            <?php
            if (isset($_SESSION["username"])) {
                echo '<a href="./reservationList.php">Lista prenotazioni</a>';
                echo '<a href="./logout.php">Logout</a>';
            } else {
                echo '<a href="./login.php">Accedi</a>';
                echo '<a href="./signup.php">Registrati</a>';
            }
            ?>
        </div>
    </nav>
    <div class="texts">
        <div class="stars">
            <img src="./assets/images/star.png" alt="">
            <img src="./assets/images/star.png" alt="">
            <img src="./assets/images/star.png" alt="">
            <img src="./assets/images/star.png" alt="">
            <img src="./assets/images/star.png" alt="">
        </div>
        <h1>HotelNUMBERS</h1>
        <h3>La prima e unica catena d'hotel alla portata di click!</h3>
    </div>
</header>