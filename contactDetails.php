<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

require_once "includes/connection.php";

// ID ophalen + beveiligen
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Ongeldig bericht ID");
}

$id = (int)$_GET['id']; // cast naar integer voor veiligheid

if ($id <= 0) {
    die("Ongeldig bericht ID");
}

// Bericht ophalen
$query = "SELECT * FROM forms WHERE id = $id LIMIT 1";
$result = mysqli_query($db, $query);

$message = mysqli_fetch_assoc($result);

if (!$message) {
    die("Bericht niet gevonden");
}

mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bericht details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
    <div class="logo">
        <a href="index.php"><img src="images/Logo_JandeVisman.png" alt="Jan de Visman"></a>
    </div>
    <div class="links">
        <a href="adminOrders.php">Bestellingen</a>
        <a href="adminContact.php">Berichten</a>
        <a href="adminLogout.php">Logout</a>
    </div>
</nav>

<main class="container">
    <section class="adminDetails">
    <h1>Bericht #<?= $message['id'] ?></h1>

    <p><strong>Naam:</strong> <?= htmlspecialchars($message['name']) ?></p>
    <p><strong>E-mail:</strong> <?= htmlspecialchars($message['email']) ?></p>
    <p><strong>Bericht:</strong></p>
    <p><?= nl2br(htmlspecialchars($message['message'])) ?></p>

    <br>
        <div class="adminDiv">
    <a href="adminContact.php">Terug naar berichten</a>
    <a href="contactDelete.php?id=<?= $id ?>">Delete Bericht</a>
        </div>
    </section>
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
