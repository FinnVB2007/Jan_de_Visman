<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: fishbasket.php');
    exit;
}

$index = null;
if (isset($_POST['index'])) {
    $index = (int)$_POST['index'];
} elseif (isset($_POST['remove_index'])) {
    $index = (int)$_POST['remove_index'];
}

if ($index === null || !isset($_SESSION['cart'][$index])) {
    header('Location: fishbasket.php');
    exit;
}

// remove and reindex
unset($_SESSION['cart'][$index]);
$_SESSION['cart'] = array_values($_SESSION['cart']);

if (empty($_SESSION['cart'])) {
    $_SESSION['empty'] = true;
}

header('Location: fishbasket.php');
exit;