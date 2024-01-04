<?php
session_start();
$allCards = json_decode(file_get_contents("card.json"), true);
$allUsers = json_decode(file_get_contents("user.json"), true);
$selectedType = isset($_GET['type']) ? $_GET['type'] : '';

$userC = [];
foreach ($allUsers as &$user) {
    if (isset($_SESSION["username"]) && $user["username"] === $_SESSION["username"]) {
        $userC = &$user;
        $money = $userC["money"];
    }
}

$filteredCards = [];
foreach ($allCards as $cardNum => $card) {
    if ($selectedType == '' || $card['type'] == $selectedType) {
        $filteredCards[$cardNum] = $card;
    }
}

if (isset($_GET["buy_card"])) {
    $cardNum = intval($_GET["buy_card"]);
    $cardPrice = $allCards[$cardNum]["price"];
    $admin = &$allUsers[array_search("admin", array_column($allUsers, "username"))];

    if (!empty($userC) && count($userC["cards"]) < 5 && $userC["money"] >= $cardPrice && in_array($cardNum, $admin["cards"])) {
        $userC["money"] -= $cardPrice;
        $userC["cards"][] = $cardNum;
        $admin["cards"] = array_diff($admin["cards"], [$cardNum]);
        $admin["cards"] = array_values($admin["cards"]);
        file_put_contents("user.json", json_encode($allUsers, JSON_PRETTY_PRINT)); // Update user data
    }

    header("Location: index.php");
    exit();
}

$shownCards = 9;
$page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
$page = max($page, 1);
$firstPage = ($page - 1) * $shownCards;
$lastPage = $firstPage + $shownCards;
$allPages = ceil(count($filteredCards) / $shownCards);

$shoCards = array_slice($filteredCards, $firstPage, $shownCards, true);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PokémonTCG</title>
    <link rel="icon" href="/sprites/favicon.ico">
    <link rel="stylesheet" href="styles.css">
    <script>
        function buyCard(cardNum) { window.location.href = '?buy_card=' + cardNum; }
    </script>
</head>
<body>
<header>
    <h2>PokémonTCG • Pokédex</h2>
</header>

<div class="sidebar">
    <?php if(isset($_SESSION["username"])): ?>
        <a href="user.php"><img href="user.php" src="/sprites/login.png" alt="User"></a>
        <a href="user.php"><?php echo $_SESSION["username"];?></a>
        <a                ><?php echo "₽ $money";?></a>
        <?php if($_SESSION["username"]=="admin"): ?>
            <a href="card2.php">Create</a>
        <?php endif?>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php"><img src="/sprites/login.png" alt="Login">Login</a>
        <a href="registration.php">Register</a>
    <?php endif; ?>
</div>

<div class="filter-form">
    <form method="get">
        <select name="type" id="type" onchange="this.form.submit()">
            <option value="">All Types</option>
            <?php
            $types = ["Bug", "Dark", "Dragon", "Electric", "Fairy", "Fighting", "Fire", "Flying", "Ghost",
                "Grass", "Ground", "Ice", "Normal", "Poison", "Psychic", "Rock", "Steel", "Water"];
            foreach ($types as $type) {
                $selected = ($selectedType === $type) ? ' selected' : '';
                echo "<option value=\"$type\"$selected>$type</option>";
            }
            ?>
        </select>
    </form>
</div>

<div class="card-placer">
    <?php foreach ($shoCards as $cardNum => $card):
        //$cardNum += 1; // Adjusting the index to match the card num

        if (!isset($allCards[$cardNum]) || !is_array($allCards[$cardNum])) {
            echo "<div class='card'>Card isn't available.</div>"; continue;
        }

        $card = $allCards[$cardNum];
        $cardType = isset($card["type"]) ? $card["type"] : "Unknown Type";
        $cardName = isset($card["name"]) ? $card["name"] : "Unknown Name";
        $cardImage = isset($card["image2"]) ? $card["image2"] : "default_image.png";

        $didBuy = false;
        $buyerName = "";
        foreach ($allUsers as $user) {
            if (in_array($cardNum, $user["cards"])) {
                $didBuy = true;
                $buyerName = $user["username"];
                break;
            }
        }

        echo "<div class='card'>";
        echo "<div class='card-image {$cardType}'><a href='card.php?card={$cardName}'><img src='{$cardImage}' alt='{$cardName}'></a></div>";
        echo "<div class='card-content'>";
        echo "<a href='card.php?card={$cardName}'><h3 class='card-name'>{$cardName}</h3></a>";
        echo "<span class='card-type {$cardType}'>{$cardType}</span>";
        echo "<div class='card-stats'>";
        echo "<span class='hp'><img src='sprites/HP.png' alt='HP'> {$card["hp"]}</span>";
        echo "<span class='attack'><img src='sprites/Attack.png' alt='Attack'> {$card["attack"]}</span>";
        echo "<span class='defense'><img src='sprites/Defense.png' alt='Defense'> {$card["defense"]}</span>";
        echo "</div>";

        if ($didBuy && $buyerName != "admin") {
            echo "<div class='card-price'>Bought by $buyerName</div>";
        } else if (isset($_SESSION["username"]) && $userC["username"] != "admin" && count($userC["cards"]) < 5) {
            echo "<div class='card-price' onclick='buyCard(\"$cardNum\")'>₽{$card["price"]}</div>";
        }
        echo "</div></div>";
    endforeach; ?>
</div>

<div class="navkeys">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>">&laquo; Previous</a>
    <?php endif; ?>
    <?php for ($i = 1; $i <= $allPages; $i++): ?>
        <a href="?page=<?= $i ?>&type=<?= $selectedType ?>" class="<?= $page === $i ? 'active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>
    <?php if ($page < $allPages): ?>
        <a href="?page=<?= $page + 1 ?>">Next &raquo;</a>
    <?php endif; ?>
</div>

<script src="script.js"></script>
</body>
<footer>
    <p>PokémonTCG • Mohammed Efaz • © • <img src="sprites/charizard2_.png"></p>
</footer>
</html>