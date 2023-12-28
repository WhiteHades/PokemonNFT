<?php
session_start();
$allCards = file_get_contents("card.json"); // Get the contents of the JSON file
$allCards2 = json_decode($allCards, true); // Decode the JSON into an associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokémonTCG</title>
    <link rel="icon" href="/sprites/favicon.ico">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h2>PokémonTCG • Pokédex</h2>
</header>

<div class="sidebar">
    <?php if(isset($_SESSION["username"])): ?>
        <a href="user.php"><img href="user.php" src="/sprites/login.png" alt="User"></a>
        <a href="user.php"><?php echo $_SESSION["username"];?></a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php"><img src="/sprites/login.png" alt="Login">Login</a>
        <a href="registration.php">Register</a>
    <?php endif; ?>
</div>

<div class="card-placer">
    <?php foreach ($allCards2 as $card): ?>
        <div class="card">
            <div class="card-image <?= $card["type"];?>">
                <a href="card.php?card=<?= $card["name"]; ?>">
                    <img src="<?= $card["image2"]; ?>" alt="<?= $card["name"]; ?>">
                </a>
            </div>
            <div class="card-content">
                <a href="card.php?card=<?= $card["name"]; ?>">
                    <h3 class="card-name"><?= $card["name"]; ?></h3>
                </a>
                <span class="card-type <?= $card["type"];?>"><?= $card["type"]; ?></span>
                <div class="card-stats">
                <span class="hp">
                    <img src="sprites/HP.png" alt="HP"> <?= $card["hp"]; ?>
                </span>
                    <span class="attack">
                    <img src="sprites/Attack.png" alt="Attack"> <?= $card["attack"]; ?>
                </span>
                    <span class="defense">
                    <img src="sprites/Defense.png" alt="Defense"> <?= $card["defense"]; ?>
                </span>
                </div>
                <div class="card-price">
                    <img src="sprites/Money.png" alt="Money"> <?= $card["price"]; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
<footer>
    <p>PokémonTCG • Mohammed Efaz • © • <img src="sprites/charizard2_.png"></p>
</footer>
</html>