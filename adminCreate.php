<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

/** @var mysqli $db */
require_once "includes/connection.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['name'] ?? '');
    $full_name = trim($_POST['full_name'] ?? '');
    $price_range = trim($_POST['price_range'] ?? '');

    // Validation
    if (empty($name)) {
        $errors['name'] = 'Naam is verplicht';
    }

    if (empty($full_name)) {
        $errors['full_name'] = 'Volledige naam is verplicht';
    }

    if (empty($price_range)) {
        $errors['price_range'] = 'Prijs is verplicht';
    }

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $errors['image'] = 'Afbeelding is verplicht';
    }

    // If no errors → insert
    if (empty($errors)) {

        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        $query = "INSERT INTO fishes (name, full_name, price_range, image)
                  VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param(
            $stmt,
            "sssb",
            $name,
            $full_name,
            $price_range,
            $null
        );

        // Needed for BLOB
        mysqli_stmt_send_long_data($stmt, 3, $imageData);

        mysqli_stmt_execute($stmt);

        header("Location: adminProducts.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Product Toevoegen</title>
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


<div>
    <form method="post" enctype="multipart/form-data">
        <div>
            <h1>Product toevoegen</h1>
        </div>


        <label>Naam</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>">
        <?php if (isset($errors['name'])) { ?>
            <span class="error"><?= $errors['name'] ?? '' ?></span>
        <?php } ?>


        <label>Volledige naam</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($full_name ?? '') ?>">
        <?php if (isset($errors['full_name'])) { ?>
        <span class="error"><?= $errors['full_name'] ?? '' ?></span>
        <?php } ?>

        <label>Prijs</label>
        <input type="text" name="price_range" value="<?= htmlspecialchars($price_range ?? '') ?>">
        <?php if (isset($errors['price_range'])) { ?>
        <span class="error"><?= $errors['price_range'] ?? '' ?></span>
        <?php } ?>

        <label>Afbeelding</label>
        <input type="file" name="image" accept="image/*">
        <?php if (isset($errors['image'])) { ?>
        <span class="error"><?= $errors['image'] ?? '' ?></span>
        <?php } ?>

        <button type="submit" class="input">Opslaan</button>

    </form>
</div>
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
