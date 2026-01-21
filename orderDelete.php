<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

// ID ophalen + beveiligen
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldig order ID");
}

$orderId = (int)$_GET['id'];

// Database connectie
require_once 'includes/connection.php';

// Order ophalen
$query = "
    SELECT id, name, email, number
    FROM orders
    WHERE id = $orderId
    LIMIT 1
";

$result = mysqli_query($db, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    mysqli_close($db);
    header('Location: adminOrders.php');
    exit;
}

// Bevestigd: verwijderen
if (isset($_POST['confirm'])) {

    // Eerst gekoppelde producten verwijderen
    mysqli_query($db, "DELETE FROM order_fish WHERE order_id = $orderId");

    // Daarna order zelf
    mysqli_query($db, "DELETE FROM orders WHERE id = $orderId");

    mysqli_close($db);
    header('Location: adminOrders.php');
    exit;
}

// Annuleren
if (isset($_POST['cancel'])) {
    mysqli_close($db);
    header('Location: adminOrderDetail.php?id=' . $orderId);
    exit;
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Order verwijderen</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <a href="adminOrders.php">
            <img src="images/Logo_JandeVisman.png" alt="Jan de Visman">
        </a>
    </div>
    <div class="links">
        <a href="adminOrders.php">Bestellingen</a>
        <a href="adminContact.php">Berichten</a>
        <a href="adminLogout.php">Logout</a>
    </div>
</nav>

<main class="mainDelete">
    <h2>Order verwijderen</h2>

    <p>
        Weet je zeker dat je het order van
        <strong><?= htmlspecialchars($order['name']) ?></strong>
        wilt verwijderen?
    </p>

    <p>
        <strong>E-mail:</strong> <?= htmlspecialchars($order['email']) ?><br>
        <strong>Telefoon:</strong> <?= htmlspecialchars($order['number']) ?>
    </p>

    <form method="post">
        <button type="submit" name="confirm">Ja, verwijderen</button>
    </form>
    <a href="orderDetails.php?id=<?= $orderId ?>" class="button">
        Annuleren
    </a>
</main>

</body>
</html>
