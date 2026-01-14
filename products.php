<?php
/** @var mysqli $db */

require_once "includes/connection.php";


$query = "SELECT * FROM fishes";
$result = mysqli_query($db, $query);

$morefishes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $morefishes[] = $row;
}

mysqli_close($db);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Producten</title>
    <link rel="stylesheet" href="css/product.css">
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
    <h1>Bekijk ons assortiment!</h1>
</header>


<main>
    <?php foreach ($morefishes as $i => $fish) { ?>
    <article>
        <h2><?= $fish['name'] ?></h2>
        <p><?= $fish['price_range'] ?></p>
        <p><?= $fish['image'] ?></p>
        <a href="detail.php?id=<?= $fish['id'] ?>">Details</a>
    </article
        <?php } ?>
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
