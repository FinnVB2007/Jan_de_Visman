<?php
session_start();
//ff voor push
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
          content="width=device-width, initial-scale=1.0">
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


<!--<header>-->
<!--    <div>-->
<!--    <h1>Bekijk ons assortiment!</h1>-->
<!--    <p>Onze verse visproducten zijn van hoge kwaliteit en slagen er zeker in jou te laten genieten!</p>-->
<!--    </div>-->
<!--</header>-->

<section>
<main>
    <section class="product">
    <?php foreach ($morefishes as $i => $fish) { ?>
    <article>
        <img src="image.php?id=<?php echo $fish['id']; ?>" width="250">
        <div class="info">
        <h2><?= $fish['name'] ?></h2>
        <p><?= $fish['price_range'] ?></p>
        <div class="buttons">
            <form action="detail.php">
        <a href="detail.php?id=<?= $fish['id'] ?>">Details</a>
            </form>
            <form action="addToFishbasket.php" method="post">
            <input type="hidden" name="id" value="<?= $fish['id']; ?>">
            <button type="submit">Reserveren</button>
        </div>
        </form>
        </div>
    </article>
        <?php } ?>
    </section>
    <section class="hook-wrapper" id="scrollTopHook">
        <img src="images/vishaak.png" alt="vishaak" class="hook">
    </section>
</main>
</section>

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
    const hook = document.querySelector('.hook-wrapper');

    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        hook.style.transform = `translateY(${scrollY * 0.3}px)`;
    });
</script>


<script>
    document.getElementById('scrollTopHook').addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>

<script>
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobileMenu');

    burger.addEventListener('click', () => {
        mobileMenu.classList.toggle('show');
    });
</script>


</body>
</html>

