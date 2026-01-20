<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

require_once "includes/connection.php";


$query = "SELECT * FROM forms";
$result = mysqli_query($db, $query);

$messages = [];
while ($row = mysqli_fetch_assoc($result)) {
    $messages[] = $row;
}

mysqli_close($db);

?>
<!doctype html>
<html lang="en">
<head>
    <title>form Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
<body>

<nav>
    <div class="logo">
        <a href="adminOrders.php"><img src="images/Logo_JandeVisman.png" alt="Jan de Visman"></a>
    </div>
    <div class="links">
        <a href="adminOrders.php">Bestellingen</a>
        <a href="adminContact.php">Berichten</a>
        <a href="adminLogout.php">Logout</a>

    </div>
</nav>
<main>
    <table class="table mx-auto">
        <thead>
        <tr>
            <th>ID</th>
            <th>Naam</th>
            <th>E-mail</th>
            <th>Message</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        <?php //loop through all albums in the collection
        foreach ($messages as $i => $message) {
            ?>
            <tr>
                <td><?= $message['id'] ?></td>
                <td><?= $message['name'] ?></td>
                <td><?= $message['email'] ?></td>
                <td><?= $message['message'] ?></td>
                <td><a href="contactDetails.php?id=<?= $message['id'] ?>">Details</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</main>

<div>
    <a href="index.php">Go back to the list</a>
</div>

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