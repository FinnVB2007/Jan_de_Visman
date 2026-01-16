<?php
session_start();

if (isset($_POST['index']) && isset($_SESSION['cart'][$_POST['index']])) {
    $index = (int)$_POST['index']; // veiligheid
    unset($_SESSION['cart'][$index]); // verwijder product
    $_SESSION['cart'] = array_values($_SESSION['cart']); // herindexeer array
}

// Check of de cart leeg is
if (empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit;
}

header('Location: fishbasket.php');
exit;