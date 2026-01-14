<?php
session_start();

$name = $_SESSION['name'];

/*
if ($name == '') {
    header('location:index.php');
}
*/

session_destroy();


?>




<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bevestiging</title>
    <link rel="stylesheet" href="css/confirmation.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
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
    <h1>
        Bedankt voor uw bericht <?=$name?>.
    </h1>
    <p>We nemen zo spoedig mogelijk contact met u op.</p>
    <a href="index.php">Bevestigen</a>
</header>
<main>
</main>
</body>
</html>