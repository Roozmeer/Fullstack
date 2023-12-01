<?php

session_start();

require('conn.php');
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>Voorziening toevoegen formulier</title>
</head>

<body>
    <header>
        <?php include('header.php') ?>
    </header>

    <h1>Voorziening toevoegen</h1>

    <div>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <input type="text" name="voorziening" placeholder="Voorziening" autofocus><br>
            <button type="submit">Submit</button>
        </form>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['voorziening'])) {
            $voorziening = $_POST['voorziening'];
        }

        $sql_in = 'INSERT INTO voorzieningen (voorziening) VALUES ("' . $voorziening . '");';
        // echo $sql;
        $result = $conn->query($sql_in);


        if (empty($result)) {
            echo "Toevoegen mislukt";
        } else {
            echo "Succesvol toegevoegd <br>Naam voorziening: " . $voorziening;
        }
    }
    ?>

    <fieldset>
        <legend class="bold">Al toegevoegde voorzieningen</legend>
        <table>
            <?php
            $sqlOut = "SELECT * FROM voorzieningen";
            $stmt = $conn->prepare($sqlOut);
            $stmt->execute();

            while ($vz = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "
            <tr>
                <td>" . $vz['voorziening'] . "</td>
            </tr>";
            }
            ?>
        </table>
    </fieldset>

</body>

</html>