<?php
session_start();
if (isset($_SESSION["username"])) { header("Location: index.php"); exit(); }

$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (empty($username) || empty($password)) $errors[] = "Username or password cannot be empty.";
    else {
        $users = json_decode(file_get_contents('user.json'), true);
        $userFound = false;
        foreach ($users as $user) {
            if ($user["username"] === $username && password_verify($password, $user["password"])) {
                $_SESSION["username"] = $username;
                $_SESSION["admin"] = ($user["username"] === "admin");
                $userFound = true;
                header("Location: index.php");
                exit();
            }
        } $errors[] = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="/sprites/favicon.ico">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h2>PokémonTCG • Login</h2>
</header>

<div class="sidebar">
    <a href="index.php"><img src="/sprites/login.png" alt="Home">Home</a>
    <a href="registration.php">Register</a>
</div>

<div class="form-c">
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?= $error ?></p>
        <?php endforeach; ?>
    <?php endif; ?>

    <form method="post" action="login.php" novalidate>
        <div class="form-u">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-u">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>

<div class="gif-c">
    <img src="sprites/red.gif" alt="Red">
</div>

<footer>
    <p>PokémonTCG • Mohammed Efaz • © • <img src="sprites/charizard2_.png"></p>
</footer>
</body>
</html>