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
    <h1>Bericht #<?= $message['id'] ?></h1>

    <p><strong>Naam:</strong> <?= htmlspecialchars($message['name']) ?></p>
    <p><strong>E-mail:</strong> <?= htmlspecialchars($message['email']) ?></p>
    <p><strong>Bericht:</strong></p>
    <p><?= nl2br(htmlspecialchars($message['message'])) ?></p>

    <br>
    <a href="adminContact.php">← Terug naar berichten</a>
    <a href="contactDelete.php?id=<?= $id ?>">Delete Bericht</a>
</main>

</body>
</html>
