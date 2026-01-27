<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

require_once "includes/connection.php";


$query = "SELECT * FROM forms";
$result = mysqli_query($db, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

mysqli_close($db);

?>
<!doctype html>
<html lang="en">
<head>
    <title>form Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="css/admin.css">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
<body>

<nav>
    <div class="logo">
        <a href="adminOrders.php"><img src="images/Logo_JandeVisman.png" alt="Jan de Visman"></a>
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
        Berichten
    </h1>


    <table class="table mx-auto">
        <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th class="delete">E-mail</th>
            <th class="delete">Message</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php //loop through all albums in the collection
        foreach ($messages as $i => $message) {
            ?>
            <tr>
                <td><?= $message['id'] ?></td>
                <td><?= $message['name'] ?></td>
                <td class="delete"><?= $message['email'] ?></td>
                <td class="delete"><?= $message['message'] ?></td>
                <td><a href="contactDetails.php?id=<?= $message['id'] ?>">Details</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
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
<script>
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');

    burger.addEventListener('click', () => {
        mobileMenu.classList.toggle('show');
    });
</script>
</body>
</html>