<?php

session_start();

require('conn.php');
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <title>Bungalow samenstellen formulier</title>
</head>

<body>
    <header>
        <?php include('header.php') ?>
    </header>

    <h1>Bungalow samenstellen</h1>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <!-- DROPDOWN -->
        <fieldset>
            <legend class="bold">Type bungalow:</legend>
            <!-- NAAM -->
            <select name="type">
                <?php
                $sql = "SELECT idtype, naam FROM type";
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<option value="' . $row['idtype'] . '">' . $row['naam'] . '</option>';
                }
                ?>
            </select>
        </fieldset>

        <!-- CHECKBOX - MULTIPLE CHOICE -->
        <fieldset>
            <legend class="bold">Voorzieningen:</legend>
            <?php
            $sql_Out = "SELECT idvoorzieningen, voorziening FROM voorzieningen";
            $stmt = $conn->prepare($sql_Out);
            $stmt->execute();

            // VOORZIENING
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                echo '<input type="checkbox" name= "voorziening[]" value="' . $row['idvoorzieningen'] . '"> 
                      <label for="' . $row['idvoorzieningen'] . '"> ' . $row['voorziening'] . '</label><br>';
            }
            ?>
        </fieldset>

        <!-- TEXTFIELD - ONLY NUMBERS -->
        <fieldset>
            <!-- PRIJS -->
            <legend class="bold">Verhuurprijs</legend>
            <label for="prijs">€</label>
            <input type="decimal" name="prijs" placeholder="499.99">
        </fieldset>

        <input type="submit" value="Submit">
    </form>

</body>

</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['type']) && isset($_POST['prijs'])) {
        $type = $_POST['type'];
        $prijs = $_POST['prijs'];

        $sql_in_type = 'INSERT INTO bungalow (idType, prijs) VALUES (' . $type . ',' . $prijs . ');';
        // echo $sql_in_type;
        $result_type = $conn->query($sql_in_type);

        if ($result_type) {
            $huisnummer = $conn->lastInsertId();
            // echo $huisnummer;
        }
    }

    if (isset($_POST['voorziening'])) {
        foreach ($_POST['voorziening'] as $val) {
            // echo "query";
            $sql_In = 'INSERT INTO bungalow_has_voorzieningen (Huisnummer, idVoorzieningen) VALUES (' . $huisnummer . ', ' . $val . ');';
            // echo $sql_In;
            $result = $conn->query($sql_In);
        }
    }

    if (empty($result_type) || empty($result)) {
        echo "Toevoegen mislukt";
    } else {
        echo "Bungalow samengesteld";
    }
}
?>