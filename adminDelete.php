<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

require_once "includes/connection.php";

// Get ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: adminProducts.php");
    exit;
}

$fishId = (int)$_GET['id'];

// Fetch fish data
$query = "SELECT * FROM fishes WHERE id = ?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "i", $fishId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$fish = mysqli_fetch_assoc($result);

if (!$fish) {
    header("Location: adminProducts.php");
    exit;
}

// Delete after confirmation
if (isset($_POST['confirm'])) {
    $deleteQuery = "DELETE FROM fishes WHERE id = ?";
    $deleteStmt = mysqli_prepare($db, $deleteQuery);
    mysqli_stmt_bind_param($deleteStmt, "i", $fishId);
    mysqli_stmt_execute($deleteStmt);

    header("Location: adminProducts.php");
    exit;
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Product verwijderen</title>
    <link rel="stylesheet" href="css/admin.css">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>

<nav>
    <div class="logo">
        <a href="adminProducts.php">
            <img src="images/Logo_JandeVisman.png" alt="Jan de Visman">
        </a>
    </div>
    <div class="links">
        <a href="adminOrders.php">Bestellingen</a>
        <a href="adminContact.php">Berichten</a>
        <a href="adminProducts.php">Producten</a>
        <a href="adminLogout.php">Logout</a>
    </div>
</nav>

<main class="mainDelete">
    <h2>Product verwijderen</h2>

    <p>
        Weet je zeker dat je het product
        <strong><?= htmlspecialchars($fish['name']) ?></strong>
        wilt verwijderen?
    </p>

    <p>
        <strong>Prijs:</strong> <?= htmlspecialchars($fish['price_range']) ?>
    </p>

    <form method="post">
        <button class="cancelButton" type="submit" name="confirm">
            Ja, verwijderen
        </button>
        <a href="adminProducts.php" class="cancelButton">
            Annuleren
        </a>
    </form>
</main>
<footer>
    <div class="footerLeft">
        <div>
            <a href="adminOrders.php"><img src="images/Logo_Footer_JandeVisman.png" alt="" class="footerLogo"></a>
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
