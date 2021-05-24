<?php

require_once 'dbconfig.php';

$err = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);

    if (
        isset($_POST["username"]) &&
        isset($_POST["password"])
    ) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);

        $query = "SELECT * FROM CLIENTI WHERE username = '$username'";
        echo $query;
        $res = mysqli_query($conn, $query);

        $password = $_POST["password"];
        if($res) {
            $row = mysqli_fetch_assoc($res);
            if (password_verify($_POST['password'], $row['password'])) {
                session_start();
                $_SESSION["username"] = $username;
                header("Location: home.php");
            } else {
                $err = "Ricontrolla i dati";
            }
        } else {
            $err = "Ricontrolla i dati";
        }
    } else {
        $err = "Non sono stati passati tutti i parametri";
    }
}
?>

<head>
    <script src="scripts/login.js" defer></script>
</head>

<body>
    <?php
    include('./header.php');
    ?>


    <form name='login' method='post' autocomplete="off" id="login" action="./login.php">
        <div>
            <div>
                <label for='username'>Username</label>
            </div>
            <div>
                <input type='text' name='username' value="<?php echo $_POST["username"] ?>">
            </div>
            <?php
            if (isset($error["username"])) {
                echo `<div><span class="error">` . $error["username"] . `</div>`;
            }
            ?>
        </div>

        <div>
            <div>
                <label for='password'>Password</label>
            </div>
            <div>
                <input type='password' name='password' value="<?php echo $_POST["password"] ?>">
            </div>
        </div>
        <?php
        if (isset($error["password"])) {
            echo `<div><span class="error">` . $error["password"] . `</div>`;
        }
        ?>

        <div class="submit">
            <input type='submit' value="Login" id="submit">
        </div>
    </form>

    <?php
    echo $err;
    include("./footer.php");
    ?>
</body>
