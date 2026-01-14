<?php
if (isset($_POST['submit'])) {
    session_start();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
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
    </div>
</nav>
<header>
    <h1>Kom in contact!</h1>
    <p>Vul het onderstaande formulier in met uw gegevens om in contact te komen met ons.</p>
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
    <h2>Voeg je Koptekst hier toe</h2>
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
