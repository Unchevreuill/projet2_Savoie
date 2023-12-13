<?php
include_once('utils/DBConfig.php');
include_once('models/CartModel.php');

$dbConfig = new DbConfig();
$pdo = $dbConfig->getConnection();

if (!$pdo) {
    echo "Erreur de connexion à la base de données";
    exit;
}

$cartModel = new \projet2_Savoie\Models\CartModel($pdo);
$cartContents = $cartModel->getCartContents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Panier</title>
    <link rel="stylesheet" href="../../css/panier.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <nav>
                <ul>
                    <li><a href="home.php">Accueil</a></li>
                    <li><a href="login.php">connexion</a></li>
                    <li><a href="inscription.php">inscription</a></li>
                    <li><a href="panier.php">Panier</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h2>Panier</h2>
        <?php if (empty($cartContents)) : ?>
            <p>Votre panier est vide.</p>
        <?php else : ?>
            <div class="row">
                <?php foreach ($cartContents as $cartItem) : ?>
                    <div class="product">
                        <img src="images/<?php echo htmlspecialchars($cartItem['url_img']); ?>" alt="<?php echo htmlspecialchars($cartItem['name']); ?>">
                        <p><?php echo htmlspecialchars($cartItem['name']); ?></p>
                        <p><?php echo htmlspecialchars($cartItem['price']); ?></p>
                        <p><?php echo htmlspecialchars($cartItem['qtty']); ?></p>
                        <p><?php echo htmlspecialchars($cartItem['price'] * $cartItem['qtty']); ?></p>
                        <button>Supprimer</button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <p>Tous droits réservés &copy; 2023 Teccart Wear</p>
    </footer>
</body>
</html>
