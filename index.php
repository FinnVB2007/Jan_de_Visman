<?php
session_start();
if (isset($_POST['submit'])) {
    unset($_SESSION['cart']);
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Jan de Visman</title>
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

<?php if (isset($_SESSION['empty'])): ?>
    <span class="help is-danger">
        <?= 'Er zitten nog geen producten in uw netje, klik op producten om iets te reserveren.' ?>
    </span>
<?php endif; ?>
<?php unset($_SESSION['empty']); ?>

<main>
    <section class="top">
        <div><img src="images/Gert-en-Jan.png" alt="Twee mannen op de foto"></div>
        <div>
            <h1>Over ons</h1>
            <p>
                Een gymleraar en een communicatieadviseur die samen verse vis bereiden en verkopen uit een omgebouwde
                paardentrailer. Is dat geen bijzonder verhaal? Waar ons verhaal begint? Bij een gezamenlijke passie voor
                vis… en gezelligheid :-).
                <br>
                <br>
                Jan deed zijn kennis en ervaring met vis op tijdens zijn bijbaan bij Visgilde Leen de Jong. Hij is
                daarnaast op het gebied van klussen een alleskunner. Onze mooie viskar is daar het resultaat van. Gert
                heeft vanuit zijn achtergrond veel kennis van communicatie en marketing. Zijn grote netwerk komt goed
                van pas.
                <br>
                <br>

                Ons doel? Leuke dingen doen, mooie plaatsen bezoeken, toffe mensen ontmoeten en hen blij maken met onze
                verse vis!
        </div>
    </section>

    <section class="bottom">
        <div>
            <h1>Ons aanbod</h1>
            <p>
                Met ons enthousiasme, verse visproducten en nostalgische viskar wordt jouw feest een succes!
                We hebben ervaring met kleine feestjes én grote evenementen… en alles wat daartussen zit.
                <br>
                <br>
                Als het met vis te maken heeft, kunnen we het waarschijnlijk leveren. We hebben een breed assortiment.
                Onze kibbeling valt enorm goed in de smaak. We zijn daarnaast gespecialiseerd in het roken van zalm. Met
                onze mobiele oven roken we ook op locatie. Dat geeft niet alleen een heerlijke geur, vaak komen mensen
                gezellig bij onze rookoven staan.
                <br>
                <br>
                Onze viskar op jouw feestje? Vul bij ‘contact’ op onze website het formulier in en we nemen contact met
                je op.
            </p>
        </div>
        <div><img src="images/Viskar.png" alt="Een paardenkar omgebouwd tot viskar"></div>
    </section>
</main>

<footer>
    <div class="footerLeft">
        <a href="index.php"><img src="images/Logo_Footer_JandeVisman.png" class="footerLogo"></a>
        <p>© 2022 Jan de Visman</p>
        <div>
            <a href="https://www.facebook.com/jandevisman/"><img src="images/facebooklogo.png" class="mediaLogo"></a>
            <a href="https://www.instagram.com/jande_visman/"><img src="images/instalogo.png" class="mediaLogo"></a>
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
