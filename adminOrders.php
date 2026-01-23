<?php
session_start();

// Check of admin is ingelogd
if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

// Database connectie
require_once "includes/connection.php";

// Haal orders + producten + quantity op
$query = "
    SELECT 
        o.id,
        o.name,
        o.email,
        o.number,
        f.name AS fish_name,
        ofi.quantity
    FROM orders o
    LEFT JOIN order_fish ofi ON o.id = ofi.order_id
    LEFT JOIN fishes f ON f.id = ofi.fish_id
    ORDER BY o.id
";

$result = mysqli_query($db, $query);

if (!$result) {
    die("SQL fout: " . mysqli_error($db));
}

// Orders structureren
$orders = [];

while ($row = mysqli_fetch_assoc($result)) {

    // Maak order aan als hij nog niet bestaat
    if (!isset($orders[$row['id']])) {
        $orders[$row['id']] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'email' => $row['email'],
                'number' => $row['number'],
                'reservation' => []
        ];
    }

    // Voeg product + quantity toe
    if (!empty($row['fish_name'])) {
        $orders[$row['id']]['reservation'][] =
                $row['fish_name'] . ' (' . $row['quantity'] . 'x)';
    }
}

// Sluit database
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Admin - Bestellingen</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playball&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Jost:wght@400;600&display=swap');
    </style>
</head>
<body>


<nav class="noPrint">
    <div class="logo">
        <a href="adminOrders.php">
            <img src="images/Logo_JandeVisman.png" alt="Jan de Visman">
        </a>
    </div>
    <div class="links">
        <a href="adminOrders.php">Bestellingen</a>
        <a href="adminContact.php">Berichten</a>
        <a href="adminLogout.php">Logout</a>
    </div>
</nav>
<script>
    function printPage() {
        window.print();
    }
</script>
<main>
    <h1 class="adminh1">
        Bestellingen
    </h1>
    <table class="table mx-auto">
        <thead>
        <tr>
            <th>Nummer</th>
            <th>Naam</th>
            <th>E-mail</th>
            <th>Telefoonnummer</th>
            <th>Producten</th>
            <th class="noPrint"></th>

        </tr>
        </thead>
        <tbody>

        <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['id']) ?></td>
                <td><?= htmlspecialchars($order['name']) ?></td>
                <td><?= htmlspecialchars($order['email']) ?></td>
                <td><?= htmlspecialchars($order['number']) ?></td>
                <td><?= implode(', ', $order['reservation']) ?></td>
                <td class="noPrint"><a href="orderDetails.php?id=<?= $order['id'] ?>" class="noPrint">Details</a></td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
    <input class="input" type="button" value="Print lijst" onclick="printPage()" class="noPrint" />
</main>

<footer class="noPrint">
    <div class="footerLeft">
        <div>
            <a href="adminOrders.php">
                <img src="images/Logo_Footer_JandeVisman.png" alt="" class="footerLogo">
            </a>
        </div>
        <div>
            <p>© 2022 Jan de Visman</p>
        </div>
        <div>
            <a href="https://www.facebook.com/jandevisman/">
                <img src="images/facebooklogo.png" alt="" class="mediaLogo">
            </a>
            <a href="https://www.instagram.com/jande_visman/">
                <img src="images/instalogo.png" alt="" class="mediaLogo">
            </a>
        </div>
    </div>
</footer>

</body>
</html>
