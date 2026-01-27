<?php
session_start();
$host = "127.0.0.1";
$database = "jan_de_visman";
$user = "root";
$password = "";

$db = mysqli_connect($host, $user, $password, $database);

if (isset($_POST['submit'])) {

    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $message = mysqli_escape_string($db, $_POST['message']);
    $_SESSION['name'] = $_POST['name'];

    $errors = [];

    if (empty($name)) {
        $errors['name'] = 'De naam moet ingevuld zijn';
    }

    if (empty($email)) {
        $errors['email'] = 'Het e-mailadres moet ingevuld zijn';
    }

    if (empty($message)) {
        $errors['message'] = 'Het bericht moet ingevuld zijn';
    }

    if (empty($errors)) {

        $query = "INSERT INTO forms(`name`, `email`, `message`) 
        VALUES ('$name','$email','$message')";
        $result = mysqli_query($db, $query);
        mysqli_close($db);
        header('Location: confirmation.php');
        exit;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="css/contact.css">
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
        <a href="index.php"><img src="images/Logo_JandeVisman.png" alt="Jan de Visman"></a>
    </div>

    <div class="links">
        <a class="home" href="index.php">Home</a>
        <a href="products.php">Producten</a>
        <a href="gallery.php">Galerij</a>
        <a href="contact.php">Contact</a>
        <section class="fishBasket">
            <a href="fishbasket.php" class="mand">
                <?php if (!empty($_SESSION['cart'])): ?>
                    <img src="images/Fishnet_2.png" alt="Visnet met producten">
                <?php else: ?>
                    <img src="images/Fishnet_1.png" alt="Leeg visnet">
                <?php endif; ?>
            </a>
        </section>
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
    <a class="home" href="index.php">Home</a>
    <a href="products.php">Producten</a>
    <a href="gallery.php">Galerij</a>
    <a href="contact.php">Contact</a>
    <a href="fishbasket.php">Visnetje</a>
</div>

<header>
    <div>
        <h1>Kom in contact!</h1>
        <p>Vul het onderstaande formulier in met uw gegevens om in contact te komen met ons.</p>
    </div>
</header>
<main>
    <form action="" method="post">
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


        <label for="message">Bericht *</label>
        <textarea name="message" id="message" placeholder="Bericht"><?= htmlentities($message ?? '')?></textarea>
        <?php if (isset($errors['message'])) { ?>
            <span class="help is-danger"><?= htmlentities($errors['message']) ?></span>
        <?php } ?>
        <button type="submit" name="submit" id="submit">Verstuur</button>


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

<script>
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');

    burger.addEventListener('click', () => {
        mobileMenu.classList.toggle('show');
    });
</script>
</body>
</html>
