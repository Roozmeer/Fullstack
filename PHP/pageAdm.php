<?php
session_start();

if (isset($_SESSION["user"])) {
} else {
    header('location: inloggen.php');
}

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin Page</title>
</head>

<body>
    <header>
        <?php require 'header.php' ?>
    </header>
    <h1>Adminpage</h1>

    <div class="btn">
        <a href="addType.php" class="link">Bungalow type toevoegen</a>
    </div>

    <div class="btn">
        <a href="addVoorziening.php" class="link">Voorziening toevoegen</a>
    </div>

    <div class="btn">
        <a href="samenstellen.php" class="link">Bungalow samenstellen</a>
    </div>

</body>

</html>