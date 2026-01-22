<?php
session_start()
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/gallery.css">
    <title>Galerij</title>
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
</nav>
<header> <h1>Onze visavonturen</h1></header>
<main>


    <article class="gallery">

        <!-- Evenementen -->
        <div class="event" data-event="juni-2025">
            <img src="images/gallery/juni2025.jpeg" alt="">
            <img src="images/gallery/juni20252.jpeg" alt="">
            <img src="images/gallery/juni20253.jpeg" alt="">
            <img src="images/gallery/juni20254.jpeg" alt="">
            <h2>Historische Markt Sommelsdijk - juni 2025</h2>
        </div>
        <div class="event" data-event="mei-2025">
            <img src="images/gallery/Mei2025.jpeg" alt="">
            <img src="images/gallery/Mei20252.jpeg" alt="">
            <h2>Bevrijdingsfestival Ooltgensplaat- Mei 2025</h2>
        </div>
        <div class="event" data-event="maart-2025">
            <img src="images/gallery/Maart2025.jpeg" alt="">
            <img src="images/gallery/Maart20252.jpeg" alt="">
            <img src="images/gallery/Maart20253.jpeg" alt="">
            <img src="images/gallery/Maart20254.jpeg" alt="">
            <h2>Ouddorps Bierfestival - Maart 2025</h2>
        </div>
        <div class="event" data-event="Oudjaarsdag -2024">
            <img src="images/gallery/Oudjaarsdag2024.jpeg" alt="">
            <img src="images/gallery/Oudjaarsdag20242.jpeg" alt="">
            <img src="images/gallery/Oudjaarsdag20243.jpeg" alt="">
            <img src="images/gallery/Oudjaarsdag20244.jpg" alt="">
            <h2>Vis roken bij Van Harberden - Oudjaarsdag 2024</h2>
        </div>
        <div class="event" data-event="HolleBolle-2024">
            <img src="images/gallery/HolleBolleDagen-Augustus2024.jpeg" alt="">
            <img src="images/gallery/HolleBolleDagen-Augustus20242.jpeg" alt="">
            <img src="images/gallery/HolleBolleDagen-Augustus20243.jpeg" alt="">
            <img src="images/gallery/HolleBolleDagen-Augustus20244.jpeg" alt="">
            <h2>Holle Bolle Dag - Augustus 2024</h2>
        </div>
        <div class="event" data-event="strand-2024">
            <img src="images/gallery/WhiskyaanhetStrand-Januari20242.jpeg" alt="">
            <img src="images/gallery/WhiskyaanhetStrand-Januari20243.jpeg" alt="">
            <img src="images/gallery/WhiskyaanhetStrand-Januari20244.jpeg" alt="">
            <img src="images/gallery/WhiskyaanhetStrand-Januari20245.jpeg" alt="">
            <h2>Whisky aan het Strand - Januari 2024</h2>
        </div>

    </article>
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

<div class="lightbox" id="lightbox">
    <span class="close">&times;</span>
    <img class="lightbox-img" src="" alt="">
    <div class="controls">
        <button id="prev">&larr;</button>
        <button id="next">&#8594</button>
    </div>
</div>
<script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.querySelector('.lightbox-img');
    const closeBtn = document.querySelector('.close');
    const nextBtn = document.getElementById('next');
    const prevBtn = document.getElementById('prev');

    let currentImages = [];
    let currentIndex = 0;

    // Klik op afbeelding
    document.querySelectorAll('.event img').forEach(img => {
        img.addEventListener('click', () => {
            const eventDiv = img.closest('.event');
            currentImages = Array.from(eventDiv.querySelectorAll('img'));
            currentIndex = currentImages.indexOf(img);

            openLightbox();
        });
    });

    function openLightbox() {
        lightbox.style.display = 'flex';
        lightboxImg.src = currentImages[currentIndex].src;
    }

    function closeLightbox() {
        lightbox.style.display = 'none';
    }

    closeBtn.addEventListener('click', closeLightbox);

    // Navigatie
    nextBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % currentImages.length;
        lightboxImg.src = currentImages[currentIndex].src;
    });

    prevBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
        lightboxImg.src = currentImages[currentIndex].src;
    });

    // Sluiten bij klik buiten afbeelding
    lightbox.addEventListener('click', e => {
        if (e.target === lightbox) closeLightbox();
    });
</script>

</body>
</html>
