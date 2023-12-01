<?php

session_start();

require('conn.php');
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>Type toevoegen formulier</title>
</head>

<body>
    <header>
        <?php include('header.php') ?>
    </header>

    <h1>Bungalow type toevoegen</h1>

    <div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="text" name="naam" placeholder="Naam type" autofocus><br>
            <input type="text" name="capaciteit" placeholder="Max aantal personen"><br>
            <input type="text" name="slaapkamers" placeholder="Aantal slaapkamers"><br>
            <button type="submit">Submit</button>
        </form>
    </div>



    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['naam'])) {
            $naam = $_POST['naam'];
        }

        if (isset($_POST['capaciteit'])) {
            $capaciteit = $_POST['capaciteit'];
        }

        if (isset($_POST['slaapkamers'])) {
            $slaapkamers = $_POST['slaapkamers'];
        }

        $sql = 'INSERT INTO type (naam, capaciteit, slaapkamers) VALUES ("' . $naam . '", ' . $capaciteit . ', ' . $slaapkamers . ');';
        // echo $sql;
        $result = $conn->query($sql);

        if (empty($result)) {
            echo "Toevoegen mislukt";
        } else {
            echo "Succesvol toegevoegd <br>Naam: " . $naam . "<br>Maximum aantal personen: " . $capaciteit . "<br>Aantal slaapkamers: " . $slaapkamers;
        }
    }
    ?>

    <fieldset>
        <legend class="bold">Al toegevoegde types</legend>
        <table>
            <tr>
                <th>Naam</th>
                <th>Capaciteit</th>
                <th>Slaapkamers</th>
            </tr>
            <?php
            $sqlOut = "SELECT * FROM type";
            $stmt = $conn->prepare($sqlOut);
            $stmt->execute();

            while ($tp = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "
            <tr>
                <td>" . $tp['naam'] . "</td>
                <td>" . $tp['capaciteit'] . "</td>
                <td>" . $tp['slaapkamers'] . "</td>
            </tr>";
            }
            ?>
        </table>
    </fieldset>

</body>

</html>