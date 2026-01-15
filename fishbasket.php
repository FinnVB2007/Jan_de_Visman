<?php
/** @var mysqli $db */
session_start();

$fishName = $_SESSION['name'];
$fishFull = $_SESSION['full_name'];
$fishPrice = $_SESSION['price_range'];

if (!isset($_SESSION['name']) || $_SESSION['name'] == '') {
  $emptyOrder = true;
    exit;
}


if (isset($_SESSION['name'])) {
    $emptyOrder = false;


    require_once "includes/connection.php";

    $fishId = mysqli_escape_string($db, $_GET['id']);

    $query = "SELECT * FROM fishes WHERE id = '$fishId'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) != 1) {
        exit;
    }
}

$fish = mysqli_fetch_assoc($result);

mysqli_close($db);
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reserveren</title>
    <link rel="stylesheet" href="css/reservation.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
<nav>
    <div class="logo">
        <a href="index.php"><img src="images/Logo_JandeVisman.png" alt="Jan de Visman"></a>
    </div>
    <div class="links">
        <a href="index.php">Home</a>
        <a href="products.php">Producten</a>
        <a href="gallery.php">Galerij</a>
        <a href="contact.php">Contact</a>
        <a href="fishbasket.php">Vismandje</a>
    </div>
</nav>
<header>
    <h1>Reserveer hier</h1>
    <p>Gebruik deze pagina om vis te reserveren.</p>
</header>
<main>
<?php

if ($emptyOrder == true)
{
    echo 'jammer';
}
?>
</main>

</main>
<footer>
    <div class="footerLeft">
        <div>
            <a href="index.php"><img src="images/Logo_Footer_JandeVisman.png" alt="" class="footerLogo"></a>
        </div>
        <div>
            <p>© 2022 Jan de Visman</p>
        </div>
        <div>
            <a href="https://www.facebook.com/jandevisman/"><img src="images/facebooklogo.png" alt="" class="mediaLogo"></a>
            <a href="https://www.instagram.com/jande_visman/"><img src="images/instalogo.png" alt="" class="mediaLogo"></a>
        </div>
    </div>
</footer>
</body>
</html>