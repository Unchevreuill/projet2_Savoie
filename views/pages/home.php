<?php
// Include necessary files
include_once('utils/DBConfig.php');
include_once('models/HomeModel.php');
include_once('controllers/HomeController.php');

// Create a PDO instance for database connection
$dbConfig = DbConfig::getInstance();
$pdo = $dbConfig->getConnection();

// Create instances of the Model and Controller
$homeModel = new \projet2_Savoie\Models\HomeModel($pdo);
$homeController = new \projet2_Savoie\Controllers\HomeController($homeModel);

// Fetch the products
$products = $homeController->getLatestProducts()
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Accueil</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="images/cart-icon.png" alt="Panier">
                    <span id="cart-count">
                        <?php
                        // Insert cart count code here
                        echo count($_SESSION['panier'] ?? []);
                        ?>
                    </span>
                </a>
            </div>
        </div>
    </header>

    <nav class="dark-nav">
        <ul>
            <li><a href="views/pages/home.php">Accueil</a></li>
            <li><a href="views/pages/inscription.php">Inscription</a></li>
            <li><a href="views/pages/login.php">Connexion</a></li>
            <li><a href="views/pages/panier.php">Panier</a></li>
            <?php if (isset($_SESSION['user'])): ?>
            <li><a href="views/pages/deconnexion.php">Déconnexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <div class="new-products">
            <h2>Nouveaux Produits</h2>
            <?php
            if (!empty($products)) {
                foreach ($products as $product) {
                    ?>
                    <div class="product">
                        <img src="images/<?php echo htmlspecialchars($product['url_img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p>Prix : $<?php echo htmlspecialchars($product['price']); ?></p>
                        <form method="post" action="home.php">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <button type="submit" name="add_to_cart">Ajouter au panier</button>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Aucun produit n'est disponible pour le moment.</p>";
            }
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
