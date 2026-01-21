<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

// ID ophalen + beveiligen
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldig bericht ID");
}

$orderId = (int)$_GET['id'];

// Connect to database
require_once 'includes/connection.php';

// Fetch data
$query = "SELECT id, name, email, message FROM forms WHERE id = $orderId LIMIT 1";
$result = mysqli_query($db, $query);
$character = mysqli_fetch_assoc($result);

if (!$character) {
    mysqli_close($db);
    header('Location: adminContact.php');
    exit;
}

// Delete query
if (isset($_POST['confirm'])) {
    mysqli_query($db, "DELETE FROM forms WHERE id = $orderId");
    mysqli_close($db);
    header('Location: adminContact.php');
    exit;
}

// Cancel deletion
if (isset($_POST['cancel'])) {
    mysqli_close($db);
    header('Location: adminDetails.php?id=' . $orderId);
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Order</title>
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
    <h2>Verwijder bericht</h2>

    <p>
        Weet je zeker dat je het bericht wilt verwijderen van
        <strong><?= htmlspecialchars($character['name']) ?></strong>?
    </p>

    <form method="post">
        <button type="submit" name="confirm">Ja, verwijder</button>
    </form>
    <a href="contactDetails.php?id=<?= $orderId ?>" class="button">
        Annuleren
    </a>
</main>

</body>
</html>
