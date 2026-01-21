<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: adminLogin.php");
    exit;
}

// Check of ID bestaat
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: adminOrders.php");
    exit;
}

$orderId = (int)$_GET['id'];

// Database connectie
require_once "includes/connection.php";

// Query voor 1 specifieke order
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
    WHERE o.id = $orderId
";

$result = mysqli_query($db, $query);

if (!$result) {
    die("SQL fout: " . mysqli_error($db));
}

// Order opbouwen
$order = null;

while ($row = mysqli_fetch_assoc($result)) {

    if ($order === null) {
        $order = [
            'id' => $row['id'],
            'name' => $row['name'],
            'email' => $row['email'],
            'number' => $row['number'],
            'products' => []
        ];
    }

    if (!empty($row['fish_name'])) {
        $order['products'][] =
            $row['fish_name'] . ' (' . $row['quantity'] . 'x)';
    }
}

mysqli_close($db);

// Als order niet bestaat
if ($order === null) {
    header("Location: adminOrders.php");
    exit;
}
?>

<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <title>Order details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
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

<main class="container">
    <h1>Order #<?= htmlspecialchars($order['id']) ?></h1>

    <p><strong>Naam:</strong> <?= htmlspecialchars($order['name']) ?></p>
    <p><strong>E-mail:</strong> <?= htmlspecialchars($order['email']) ?></p>
    <p><strong>Telefoon:</strong> <?= htmlspecialchars($order['number']) ?></p>

    <h3>Producten</h3>
    <ul>
        <?php foreach ($order['products'] as $product): ?>
            <li><?= htmlspecialchars($product) ?></li>
        <?php endforeach; ?>
    </ul>

    <br>

    <a href="adminOrders.php">← Terug naar bestellingen</a>

    <a href="orderDelete.php?id=<?= $order['id'] ?>">
        Verwijder order
    </a>
</main>

</body>
</html>
