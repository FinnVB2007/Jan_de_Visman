<?php
/** @var mysqli $db */
require_once "includes/connection.php";
session_start();
session_destroy();

if (isset($_POST['submit'])) {
    $formId = mysqli_escape_string($db, $_POST['id']);
    $name = mysqli_escape_string($db, $_POST['name']);
    $email = mysqli_escape_string($db, $_POST['email']);
    $message = mysqli_escape_string($db, $_POST['message']);

    $form = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
    ];

    $errors = [];

    if (empty($name)) {
        $errors['name'] = 'De naam moet ingevuld zijn';
    }

    if (empty($email)) {
        $errors['email'] = 'Het e-mailadres moet ingevuld zijn';
    }

    if (empty($message)) {
        $errors['message'] = 'Het bericht moet ingevuld zijn';
    }

    if (empty($errors)) {

        $query = "UPDATE forms
SET name = '$name', email = '$email', message = '$message'
WHERE id = '$formId'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
} else if (isset($_GET['id'])) {
    $formId = $_GET['id'];

    $query = "SELECT * FROM forms WHERE id = " . mysqli_escape_string($db, $formId);
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $form = mysqli_fetch_assoc($result);
    } else {

    }
} else {

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
        <a href="index.php"><img src="images/Logo_JandeVisman.png" alt="Jan de Visman"></a>
    </div>
    <div class="links">
        <a href="admin.php">Admin</a>
        <a href="index.php">Home</a>
        <a href="products.php">Producten</a>
        <a href="gallery.php">Galerij</a>
        <a href="contact.php">Contact</a>
    </div>
</nav>

<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="name">name</label>
        <input id="name" type="text" name="name" value="<?= htmlentities($form['name'] ?? '') ?>"/>

    </div>
    <div class="data-field">
        <label for="email">email</label>
        <input id="email" type="text" name="email" value="<?= htmlentities($form['email'] ?? '') ?>"/>

    </div>
    <div class="data-field">
        <label for="message">message</label>
        <input id="message" type="text" name="message" value="<?= htmlentities($form['message'] ?? '') ?>"/>

    </div>
</form>
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