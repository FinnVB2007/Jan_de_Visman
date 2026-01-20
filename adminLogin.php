<?php
//connect to database
//if form is filled in
//then check if password and username are correct
//if not? show error
//otherwise send to the mainpage


session_start();
require_once 'includes/connection.php';

$errors = [];
$redirect = $_GET['redirect'] ?? 'index.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $redirect = $_POST['redirect'] ?? 'adminContact.php'; // default after login

    if ($username === '') $errors['username'] = 'Username is required';
    if ($password === '') $errors['password'] = 'Password is required';

    if (empty($errors)) {
        $usernameEsc = mysqli_real_escape_string($db, $username);
        $result = mysqli_query($db, "SELECT id, password FROM admins WHERE username = '$usernameEsc' LIMIT 1");

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $username;
                header("Location: " . $redirect);
                exit;
            } else {
                $errors['login'] = 'Invalid username or password';
            }
        } else {
            $errors['login'] = 'Invalid username or password';
        }
    }
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<section>
    <form method="post">
        <input type="hidden" name="redirect" value="<?= htmlspecialchars($redirect) ?>">
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <button type="submit" name="login">Login</button>
        <?php if (isset($errors['login'])) echo "<p>{$errors['login']}</p>"; ?>
    </form>
</section>
</body>
</html>