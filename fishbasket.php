<?php
/** @var mysqli $db */
session_set_cookie_params(0); // cookie vervalt bij browser sluiten
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $_SESSION['empty'] = true;
    header('Location: index.php');
    exit;
}



$cart = $_SESSION['cart'];
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reserveren</title>
    <link rel="stylesheet" href="css/reservation.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
</head>
<body>
<nav>
    <div class="logo">
        <a href="index.php"><img src="images/Logo_JandeVisman.png" alt="Jan de Visman"></a>
    </div>
    <div class="links">
        <a href="index.php">Home</a>
        <a href="products.php">Producten</a>
        <a href="gallery.php">Galerij</a>
        <a href="contact.php">Contact</a>
        <section class="fishBasket">
            <a href="fishbasket.php"><img src="images/Fishnet.png" alt="Vismandje"></a>
        </section>
    </div>
</nav>
<header>
    <h1>Reserveer overzicht</h1>

    <h2>Vul uw contactgegevens in</h2>
</header>
<main>
    <form class="formBasket" action="" method="post">
        <label for="name">Naam *</label>
        <input type="text" id="name" name="name" placeholder="Naam" value="<?= htmlentities($name ?? '')?>">
        <?php if (isset($errors['name'])) { ?>
            <span class="help is-danger"><?= htmlentities($errors['name']) ?></span>
        <?php } ?>

        <label for="email">E-mailadres *</label>
        <input type="text" id="email" name="email" placeholder="E-mailadres"
               value="<?= htmlentities($email ?? '')?>">
        <?php if (isset($errors['email'])) { ?>
            <span class="help is-danger"><?= htmlentities(($errors['email'])) ?></span>
        <?php } ?>

        <label for="number">Telefoonnummer *</label>
        <input type="number" id="number" name="number" placeholder="Telefoonnummer"
               value="<?= htmlentities($number ?? '')?>">
        <?php if (isset($errors['number'])) { ?>
            <span class="help is-danger"><?= htmlentities(($errors['number'])) ?></span>
        <?php } ?>
    </form>

    <h2 class="mainTitle">Deze producten zitten in uw winkelwagen</h2>

    <?php foreach ($cart as $index => $item): ?>
        <article>
            <p><?= htmlspecialchars($item['full'] ?? ''); ?></p>
            <p><?= htmlspecialchars($item['price'] ?? ''); ?></p>
            <form method="post" action="removeProduct.php">
                <input type="hidden" name="index" value="<?= $index; ?>">
                <button type="submit">Verwijderen</button>
            </form>
        </article>
    <?php endforeach; ?>
    <form class="formConfirm" action="orderconfirmation.php">
        <button type="submit">Reserveer!</button>
    </form>



</main>

<footer>
    <div class="footerLeft">
        <div>
            <a href="index.php"><img src="images/Logo_Footer_JandeVisman.png" alt="" class="footerLogo"></a>
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