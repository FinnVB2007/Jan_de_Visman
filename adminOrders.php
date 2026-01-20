<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}


//connect to database
//Fetch data and join tables
//loop through the result
//create an array
//close database

//load the data from the created array based of the id per row

//---------------------------------


//connect db
require_once "includes/connection.php";

//get the data from the database with a SQL query
//get the data from the database with a SQL query
$query = "
    SELECT 
        o.id,
        o.name,
        o.email,
        o.number,
        f.name AS fish_name
    FROM orders o
    LEFT JOIN order_fish ofi ON o.id = ofi.order_id
    LEFT JOIN fishes f ON f.id = ofi.fish_id
    ORDER BY o.id
";

$result = mysqli_query($db, $query);

// loop through the result to create a custom array
$orders = [];

while ($row = mysqli_fetch_assoc($result)) {
    if (!isset($orders[$row['id']])) {
        $orders[$row['id']] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'number' => $row['number'],
                'reservation' => []
        ];
    }

    // voeg vis toe als die bestaat
    if (!empty($row['fish_name'])) {
        $orders[$row['id']]['reservation'][] = $row['fish_name'];
    }
}
//close connection
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
            <th>Telefoonnummer</th>
            <th>Producten</th>

        </tr>
        </thead>
        <tbody>

        <?php //loop through all albums in the collection
        foreach ($orders as $i => $order) {
            ?>
            <tr>
                <td><?= $order['id'] ?></td>
                <td><?= $order['name'] ?></td>
                <td><?= $order['email'] ?></td>
                <td><?= $order['number'] ?></td>
                <td><?= implode(', ', $order['reservation']) ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>


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