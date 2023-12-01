<?php

session_start();

require('conn.php');

if (isset($_GET["loguit"])) {
    $_SESSION = array();
    session_destroy();
}

?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>login formulier</title>
</head>

<body>
    <header>
        <?php include('header.php') ?>
    </header>

    <h1>Log in</h1>

    <div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="text" name="naam" placeholder="Gebruikersnaam" autofocus><br>
            <input type="password" name="wachtwoord" placeholder="Wachtwoord"><br>
            <button type="submit">Submit</button>
        </form>
    </div>


</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['naam'])) {
        $gebruiker = $_POST['naam'];
    }

    if (isset($_POST['wachtwoord'])) {
        $wachtwoord = $_POST['wachtwoord'];
    }

    $stmt = $conn->prepare("SELECT gebruiker, wachtwoord FROM inlog WHERE gebruiker = ? AND wachtwoord = ?");
    $stmt->execute([$gebruiker, $wachtwoord]);
    $result = $stmt->fetch();

    if (empty($result)) {
        echo "Naam of wachtwoord komt niet overeen met de database";
    } else {
        $_SESSION["user"] = $_POST["naam"];
        // print_r($_SESSION);
        header('location: pageAdm.php');
    }
}

// $passwordHash = password_hash($password, PASSWORD_DEFAULT);


if (isset($_GET["loguit"])) {
    echo "U bent uitgelogd";
}


?>