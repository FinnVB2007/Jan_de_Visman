<?php
session_start();

if (isset($_POST['submit'])) {
    unset($_SESSION['cart']);
    header('location:index.php');
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orderbevestiging</title>
    <link rel="stylesheet" href="css/orderconfirmation.css">
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
    </div>
</nav>
<header>
    <h1>Bedankt voor het reserveren!</h1>
    <p>We nemen zo spoedig mogelijk contact met u op voor de bestelling.</p>
    <form action="" method="post">
        <button name="submit" type="submit">Ga terug</button>
    </form>
</header>

</html>
