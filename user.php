<?php
session_start();
if (!isset($_SESSION["username"])) { header("Location: login.php"); exit(); }

$users = json_decode(file_get_contents("user.json"), true);
$cards = json_decode(file_get_contents("card.json"), true);
$userC = &$users[array_search($_SESSION["username"], array_column($users, "username"))];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sell_card"])) {
    $cardNum = $_POST["sell_card"];
    if (in_array($cardNum, $userC["cards"])) {
        $userC["money"] += round($cards[$cardNum]["price"] * 0.9);
        $userC["cards"] = array_values(array_diff($userC["cards"], [$cardNum]));
        $users[array_search("admin", array_column($users, "username"))]["cards"][] = (int)$cardNum;
        file_put_contents("user.json", json_encode($users, JSON_PRETTY_PRINT));
    }
}
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
    <h2>PokémonTCG • User</h2>
</header>

<div class="sidebar">
    <a href="user.php"><img href="user.php" src="/sprites/login.png" alt="User"></a>
    <a href="user.php"><?php echo $_SESSION["username"];?></a>
    <a href="index.php">Home</a>
    <a href="logout.php">Log Out</a>
</div>

<div class="form-c">
    <p>Username: <?=$userC["username"]?></p>
    <p>Email: <?=$userC["email"]?></p>
    <p>Pokédollar: ₽ <?=$userC["money"]?></p>
</div>
<h2>Cards</h2>
<div class="card-placerii">
    <div class="card-placeri">
        <?php foreach ($userC["cards"] as $cardNum):
            $card = json_decode(file_get_contents("card.json"), true)[$cardNum]; ?>
            <div class='card'>
                <div class='card-image <?= $card["type"]; ?>'>
                    <a href='card.php?card=<?= $card["name"]; ?>'>
                        <img src='<?= $card["image2"]; ?>' alt='<?= $card["name"]; ?>'>
                    </a>
                </div>
                <div class='card-contenti'>
                    <a href='card.php?card=<?= $card["name"]; ?>'>
                        <h3 class='card-name'><?= $card["name"]; ?></h3>
                    </a>
                    <span class='card-type <?= $card["type"]; ?>'><?= $card["type"]; ?></span>
                    <div class='card-stats'>
                        <span class='hp'><img src='sprites/HP.png' alt='HP'> <?= $card["hp"]; ?></span>
                        <span class='attack'><img src='sprites/Attack.png' alt='Attack'> <?= $card["attack"]; ?></span>
                        <span class='defense'><img src='sprites/Defense.png' alt='Defense'> <?= $card["defense"]; ?></span>
                    </div>

                    <?php if (!isset($userC["admin"]) || !$userC["admin"]): ?>
                        <form method='post'>
                            <button type='submit' name='sell_card' value='<?= $cardNum; ?>'>Sell ₽<?= $card["price"] * 0.9; ?></button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<footer>
    <p>PokémonTCG • Mohammed Efaz • © • <img src="sprites/charizard2_.png"></p>
</footer>
</body>
</html>