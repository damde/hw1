<?php
$error =  [
    'username'     => '',
    'password'     => '',
    'email'     => '',
    'system' => ''
];

require_once 'dbconfig.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die($conn);
    if (
        isset($_POST["name"]) &&
        isset($_POST["surname"]) &&
        isset($_POST["username"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"])
    ) {
        $username = mysqli_real_escape_string($conn, $_POST["username"]);

        if (!preg_match('/^[a-zA-Z0-9_]{4,32}$/', $username)) {
            $error["username"] = "Username non rispetta le condizioni(a-Z, 0-9 _, min 4 char)";
        } else {
            $query = "SELECT * FROM CLIENTI
                              WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error["username"] = "Username giá in uso";
            }
        }
        $email = mysqli_real_escape_string($conn, $_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error["email"] = "Email non valida";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM CLIENTI WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error["email"] = "Email giá in uso";
            }
        }



        $password = $_POST["password"];

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            $error["password"] = "La password non rispetta le condizioni";
        }
        if (!$error["username"] && !$error["email"] && !$error["password"]) {
            $name = mysqli_real_escape_string($conn, $_POST["name"]);
            $surname = mysqli_real_escape_string($conn, $_POST["surname"]);
            $password = password_hash($password, PASSWORD_BCRYPT);

            $query = "INSERT INTO CLIENTI(username, name, surname, email, password)
                      VALUES('$username', '$name', '$surname', '$email', '$password')";

            // controllo se la query é andata a buon fine(mixed or bool)
            if (mysqli_query($conn, $query)) {
                print_r("tutto ok");
                mysqli_close($conn);
                session_start();
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit;
            } else {
                print_r("non é tutto ok");
                $error["system"] = "Errore durante l'inserimento del nuovo utente";
            }
        }
        echo $error["system"];
    } else {
        $error["system"] = "Non sono stati passati tutti i parametri";
    }
}
?>
<?php
include "./header.php";
?>

<head>
    <script src="scripts/signup.js" defer></script>

</head>
<form name='signup' method='post' autocomplete="off" id="signup" action="./signup.php" onsubmit="return validateform(this)" >
    <div class="sameline">
        <div class="name">
            <div>
                <label for='name'>Nome</label>
            </div>
            <div>
                <input type='text' name='name' value="<?php echo $_POST["name"] ?>">
            </div>
        </div>
        <div class="surname">
            <div>
                <label for='surname'>Cognome</label>
            </div>
            <div>
                <input type='text' name='surname' value="<?php echo $_POST["surname"] ?>">
            </div>
        </div>
    </div>

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
            <label for='email'>Email</label>
        </div>
        <div>
            <input type='text' name='email' value="<?php echo $_POST["email"] ?>">
        </div>
        <?php
        if (isset($error["email"])) {
            echo `<div><span class="error">` . $error["email"] . `</div>`;
        }
        ?>
    </div>

    <div class="sameline">
        <div>
            <div>
                <label for='password'>Password</label>
            </div>
            <div>
                <input type='password' name='password' value="<?php echo $_POST["password"] ?>">
            </div>
        </div>
        <div>
            <div>
                <label for='ppassword'>Conferma Password</label>
            </div>
            <div>
                <input type='password' name='ppassword' value="<?php echo $_POST["ppassword"] ?>">
            </div>
        </div>
    </div>
    <?php
    if (isset($error["password"])) {
        echo `<div><span class="error">` . $error["password"] . `</div>`;
    }
    ?>

    <div class="submit">
        <input type='submit' value="Registrati" id="submit">
    </div>
</form>

<?php
include "./footer.php";
?>