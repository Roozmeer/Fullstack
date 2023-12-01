<?php
session_start();

require('conn.php');
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css" type="text/css">
    <title>Bungalows</title>
</head>

<body>
    <header>
        <?php require 'header.php' ?>
    </header>
    <h1 class="center">Bungalows aanwezig in het park</h1>

    <!-- VOORBEELD -->
    <!-- <fieldset>
        <legend class="bold">Bungalow 0 (voorbeeld)</legend>
        Type bungalow: Garnaal<br>
        Max. 4 personen<br>
        2 slaapkamers<br>
        Voorzieningen aanwezig: oven, openhaard, vaatwasser<br>
        Prijs per nacht: <strong>€499.99</strong>
    </fieldset> -->

    <?php
    $sql = "SELECT 
            bungalow.Huisnummer, 
            type.idType, 
            bungalow.prijs, 
            type.naam, 
            type.capaciteit, 
            type.slaapkamers
    FROM bungalow
    INNER JOIN type ON bungalow.idType = type.idType;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    while ($bgl = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "
            <fieldset>
                <legend class='bold'>Bungalow " . $bgl['Huisnummer'] . "</legend>
                Type bungalow: " . $bgl['naam'] . "<br>
                Max. " . $bgl['capaciteit'] . " personen
                <br>" . $bgl['slaapkamers'] . " slaapkamers<br>
                Voorzieningen aanwezig: ";

        $sql_vz = "SELECT 
                bungalow_has_voorzieningen.idVoorzieningen, 
                voorzieningen.voorziening,
                bungalow.Huisnummer
        FROM bungalow_has_voorzieningen
        LEFT JOIN bungalow ON bungalow_has_voorzieningen.Huisnummer = bungalow.Huisnummer
        LEFT JOIN voorzieningen ON bungalow_has_voorzieningen.idVoorzieningen = voorzieningen.idVoorzieningen
        WHERE bungalow.Huisnummer = " . $bgl['Huisnummer'];
        $stmt_vz = $conn->prepare($sql_vz);
        $stmt_vz->execute();

        while ($vz = $stmt_vz->fetch(PDO::FETCH_ASSOC)) {
            echo $vz['voorziening'];
            echo ", ";
        }
        echo "<br>Prijs per nacht:<strong> €" . $bgl['prijs'] . "</strong><br>
            <button>Reserveer</button>
            </fieldset>";
    }

    ?>
</body>

</html>