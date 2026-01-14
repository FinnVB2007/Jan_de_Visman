<?php
/** @var mysqli $db */


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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.4/css/bulma.min.css">
    <title>Details - <?= $fish['name'] ?></title>
</head>
<body>
<div class="container px-4">
    <h1 class="title mt-4"><?= $fish['full_name'] ?></h1>
    <section class="content">
        <ul>
            <li>lenght: <?= $fish['price_range'] ?></li>
            <li>premiere: <?= $fish['image'] ?></li>
        </ul>
    </section>
    <div>
        <a class="button" href="index.php">Terug naar productpagina</a>
    </div>
</div>
</body>
</html>

