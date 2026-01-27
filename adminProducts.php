<?php
session_start();

// Check of admin is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

// Database connectie
require_once "includes/connection.php";


$query = "SELECT * FROM fishes";
$result = mysqli_query($db, $query);

$morefishes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $morefishes[] = $row;
}

// Sluit database
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Admin - Bestellingen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/admin.css">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:wght@400;600&display=swap');
    </style>
</head>
<body>


<nav class="noPrint">
    <div class="logo">
        <a href="adminOrders.php">
            <img src="images/Logo_JandeVisman.png" alt="Jan de Visman">
        </a>
    </div>
    <div class="links">
        <a href="adminOrders.php">Bestellingen</a>
        <a href="adminContact.php">Berichten</a>
        <a href="adminProducts.php">Producten</a>
        <a href="adminLogout.php">Logout</a>
    </div>
    <!-- Burger -->
    <div class="burger" id="burger">
        <div></div>
        <div></div>
        <div></div>
    </div>
</nav>

<!-- Mobiel menu -->
<div class="mobile-menu" id="mobileMenu">
    <a href="adminOrders.php">Bestellingen</a>
    <a href="adminContact.php">Berichten</a>
    <a href="adminProducts.php">Producten</a>
    <a href="adminLogout.php">Logout</a>
</div>

<main>
<h1 class="adminh1">
   Producten
</h1>
<table class="table mx-auto">
    <thead>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Prijs</th>
        <th></th>

    </tr>
    </thead>
    <tbody>

    <?php foreach ($morefishes as $i => $fish): ?>
        <tr>
            <td><?= htmlspecialchars($fish['id']) ?></td>
            <td><?= htmlspecialchars($fish['name']) ?></td>
            <td><?= htmlspecialchars($fish['price_range']) ?></td>
            <td><a href="adminDelete.php?id=<?= $fish['id'] ?>">Delete</a></td>

        </tr>
    <?php endforeach; ?>

    </tbody>
</table>
    <div class="prod">
        <a href="adminCreate.php" class="productButton">Nieuw Product Toevoegen</a>
    </div>
</main>

<footer class="noPrint">
    <div class="footerLeft">
        <div>
            <a href="adminOrders.php">
                <img src="images/Logo_Footer_JandeVisman.png" alt="" class="footerLogo">
            </a>
        </div>
        <div>
            <p>© 2022 Jan de Visman</p>
        </div>
        <div>
            <a href="https://www.facebook.com/jandevisman/">
                <img src="images/facebooklogo.png" alt="" class="mediaLogo">
            </a>
            <a href="https://www.instagram.com/jande_visman/">
                <img src="images/instalogo.png" alt="" class="mediaLogo">
            </a>
        </div>
    </div>
</footer>

<script>
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');

    burger.addEventListener('click', () => {
        mobileMenu.classList.toggle('show');
    });
</script>

</body>
</html>
