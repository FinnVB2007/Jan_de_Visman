<?php
// 1. Verbinding maken met jouw database
$conn = new mysqli("localhost", "root", "", "jan_de_visman");

// Controleer of de verbinding werkt
if ($conn->connect_error) {
    die("Database fout: " . $conn->connect_error);
}

// 2. Controleer of er een id is meegegeven
if (!isset($_GET['id'])) {
    die("Geen id opgegeven.");
}

$id = (int)$_GET['id'];

// 3. Haal de afbeelding op uit jouw tabel
$stmt = $conn->prepare("SELECT image FROM fishes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// 4. Check of er wel een foto bestaat
if ($result->num_rows === 0) {
    die("Geen afbeelding gevonden.");
}

$row = $result->fetch_assoc();

// 5. Zeg tegen de browser: dit is een afbeelding
header("Content-Type: image/png");

// 6. Stuur de afbeelding naar de browser
echo $row['image'];
?>

