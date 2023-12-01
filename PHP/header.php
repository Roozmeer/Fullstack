<head>
    <link rel="stylesheet" href="../css/style.css">
    <?php
    if (isset($_SESSION["user"])) {
        echo "<style>.grid-con {grid-template-columns: 210px auto auto auto auto;}</style>";
    } else {
        echo "<style>.grid-con {grid-template-columns: 210px auto auto auto;}</style>";
    }
    ?>
</head>

<header class="grid-con">
    <!-- HOME -->
    <div class="grid-item">
        <a href="index.php" class="link bold">
            <img src="../img/logo4.jpg" class="logo">
        </a>
    </div>

    <!-- HOME -->
    <div class="grid-item">
        <a href="index.php" class="link bold">Home</a>
    </div>

    <!-- BUNGALOW LIST -->
    <div class="grid-item">
        <a href="bungalowList.php" class="link bold">Reserveer nu</a>
    </div>
    <?php
    if (isset($_SESSION["user"])) {
        echo "<div class='grid-item'><a href='pageAdm.php' class='link bold'>Admin</a></div>";
        echo "<div class='grid-item'><a href='inloggen.php?loguit' id='loguit' class='link bold'>Uitloggen</a></div>";
    } else {
        echo "<div class='grid-item'><a href='inloggen.php' class='link bold'>Admin</a></div>";
    }
    ?>
</header>