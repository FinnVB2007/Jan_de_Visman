<?php
/** @var mysqli $db */
require_once "includes/connection.php";


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
<body>
<h1>Edit "<?= htmlentities($form['name']) . ' - ' . htmlentities($form['email']) ?>"</h1>

<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="name">name</label>
        <input id="name" type="text" name="name" value="<?= htmlentities($form['name']) ?>"/>
        <span class="errors"><?= isset($errors['name']) ? $errors['name'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="director">director</label>
        <input id="director" type="text" name="director" value="<?= htmlentities($form['director']) ?>"/>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="lenght">lenght</label>
        <input id="lenght" type="text" name="lenght" value="<?= htmlentities($form['lenght']) ?>"/>
        <span class="errors"><?= isset($errors['message']) ? $errors['message'] : '' ?></span>
    </div>
    <div class="data-submit">
        <input type="hidden" name="id" value="<?= $formId ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="index.php">Go back to the list</a>
</div>
</body>
</html>