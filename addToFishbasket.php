<?php
session_start();
require_once "includes/connection.php";

if (!isset($_POST['id'])) {
    header("Location: index.php");
    exit;
}

$id = mysqli_escape_string($db, $_POST['id']);

$query = "SELECT * FROM fishes WHERE id = '$id'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) !== 1) {
    header("Location: index.php");
    exit;
}

$fish = mysqli_fetch_assoc($result);

// Cart aanmaken als hij nog niet bestaat
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Product toevoegen
$_SESSION['cart'][] = [
    'id' => $id,
    'name' => $fish['name'],
    'full'  => $fish['full_name'],
    'price' => $fish['price_range']
];

mysqli_close($db);

// Ga naar winkelmand
header("Location: fishbasket.php");
exit;