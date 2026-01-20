<?php
session_set_cookie_params(0);
session_start();
/** @var mysqli $db */

$id = $_GET['id'];
if (!isset($_GET['id']) || $_GET['id'] == '') {
    header('Location: index.php');
    exit;
}

require_once "includes/connection.php";

$fishId = mysqli_escape_string($db, $_GET['id']);

$query = "SELECT * FROM fishes WHERE id = '$fishId'";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) != 1) {
    header('Location: index.php');
    exit;
}

$fish = mysqli_fetch_assoc($result);

mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    </style>

    <link rel="stylesheet" href="css/detail.css">

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


    <title>Details - <?= $fish['name'] ?></title>
</head>
<body>
<main>
    <div class="container px-4">
        <h1 class="title mt-4"><?= $fish['name'] ?></h1>
        <section class="content">
            <ul>
                <li>Volledige naam: <?= $fish['full_name'] ?></li>
                <li>Price range: <?= $fish['price_range'] ?></li>
                <img src="image.php?id=<?php echo $id; ?>" width="250">
            </ul>
        </section>
        <div>
            <a class="button" href="products.php">Terug naar productpagina</a>
            <form action="add_to_fishbasket.php" method="post">
                <input type="hidden" name="id" value="<?= $fish['id']; ?>">
                <button type="submit">Reserveren</button>
            </form>
        </div>
    </div>
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
