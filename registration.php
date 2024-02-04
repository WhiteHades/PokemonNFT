<?php
session_start();

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $users = json_decode(file_get_contents("user.json"), true);
    $usernames = array_column($users, "username");
    $emails = array_column($users, "email");

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) $errors[] = "No fields can be empty";
    else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email format wrong";
        if (strlen($username) < 3 || strlen($username) > 10) $errors[] = "Username has to be 3-10 characters long";
        if (strlen($password) < 3 || strlen($password) > 10) $errors[] = "Password has to be 3-10 characters long";
        if ($password !== $confirm_password) $errors[] = "Passwords don't match";
        if (in_array($username, $usernames)) $errors[] = "Username exists";
        if (in_array($email, $emails)) $errors[] = "Email exists";
    }

    if (empty($errors)) {
        $encrypt_password = password_hash($password, PASSWORD_DEFAULT);
        $users[] = [
            "username" => $username,
            "email" => $email,
            "password" => $encrypt_password,
            "money" => 5000,
            "cards" => []
        ];
        file_put_contents("user.json", json_encode($users, JSON_PRETTY_PRINT));
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="icon" href="/sprites/favicon.ico">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h2>PokémonTCG • Register</h2>
</header>

<div class="sidebar">
    <a href="index.php"><img src="/sprites/login.png" alt="Home">Home</a>
    <a href="login.php">Login</a>
</div>

<div class="form-c">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="post" action="registration.php" novalidate>
        <div class="form-u">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-u">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-u">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div class="form-u">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit">Register</button>
    </form>
</div>

<div class="gif-c">
    <img src="sprites/pikachu2.gif" alt="Pikachu">
</div>

<footer>
    <p>PokémonTCG • Mohammed Efaz • © • <img src="sprites/charizard2_.png"></p>
</footer>
</body>
</html>
