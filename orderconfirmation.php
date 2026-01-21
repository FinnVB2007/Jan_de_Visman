<?php
session_start();
require_once 'includes/connection.php';

// Controleer of er een order wordt geplaatst
if (!isset($_SESSION['order_contact']) || empty($_SESSION['cart'])) {
    // Geen ordergegevens of lege winkelwagen, terug naar index
    header('Location: index.php');
    exit;
}

// Haal en escapen van contactgegevens
$name = mysqli_real_escape_string($db, $_SESSION['order_contact']['name']);
$email = mysqli_real_escape_string($db, $_SESSION['order_contact']['email']);
$number = mysqli_real_escape_string($db, $_SESSION['order_contact']['number']);

// Insert order
$orderQuery = "INSERT INTO orders (name, email, number) VALUES ('$name', '$email', '$number')";
if (!mysqli_query($db, $orderQuery)) {
    die("Fout bij toevoegen van order: " . mysqli_error($db));
}

// Haal het order ID
$orderId = mysqli_insert_id($db);

// Verwerk winkelwagen voor quantity
$product_ids = array_column($_SESSION['cart'], 'id');
$product_counts = array_count_values($product_ids); // telt duplicates

// Bereid bulk insert voor order_fish
$values = [];
foreach ($product_counts as $fish_id => $qty) {
    $fish_id_safe = mysqli_real_escape_string($db, $fish_id);
    $values[] = "($orderId, $fish_id_safe, $qty)";
}

if (!empty($values)) {
    $values_str = implode(',', $values);
    $fishQuery = "INSERT INTO order_fish (order_id, fish_id, quantity) VALUES $values_str";
    if (!mysqli_query($db, $fishQuery)) {
        die("Fout bij toevoegen van order_fish: " . mysqli_error($db));
    }
}

// Leeg de cart
unset($_SESSION['cart']);

// Redirect naar index of een bevestigingspagina
header('Location: orderconfirmation.php');
exit;
?>



?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orderbevestiging</title>
    <link rel="stylesheet" href="css/orderconfirmation.css">
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
    </div>
</nav>
<header>
    <h1>Bedankt voor het reserveren!</h1>
    <p>We nemen zo spoedig mogelijk contact met u op voor de bestelling.</p>
    <form action="" method="post">
        <button name="submit" type="submit">Ga terug</button>
    </form>
</header>

</html>
