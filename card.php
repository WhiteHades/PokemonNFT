<?php
$allCards = file_get_contents("card.json");
$allCards2 = json_decode($allCards, true);

$name = isset($_GET["card"]) ? $_GET["card"] : null;

$temp = null;
foreach ($allCards2 as $card) { if ($card["name"] === $name) { $temp = $card; break; } }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$temp["name"];?></title>
    <link rel="icon" href="sprites/favicon.ico">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h2>PokémonTCG • Pokédex • <?=$temp["name"];?></h2>
</header>
<div class="card-d">
    <div class="card-imagei <?= $temp["type"]; ?>">
        <img src="<?= $temp["image2"]; ?>" alt="<?= $temp["name"]; ?>">
    </div>
    <div class="card-i">
        <h3><?= $temp["name"]; ?> • <?=$temp["type"];?></h3>
        <p>
            <strong>HP:</strong><?=$temp["hp"];?>  •
            <strong>Attack:</strong> <?=$temp["attack"];?> •
            <strong>Defense:</strong> <?=$temp["defense"];?>
        </p>
        <p><?=$temp["description"];?></p>
        <div class="card-a">
            <button onclick="location.href='index.php'">Explore Pokédex</button>
        </div>
    </div>
</div>
</body>
<footer>
    <p>PokémonTCG • Mohammed Efaz • © • <img src="sprites/charizard2_.png"></p>
</footer>
</html>