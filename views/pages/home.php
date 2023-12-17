<?php
// Include necessary files
include_once('utils/DBConfig.php');
include_once('models/HomeModel.php');
include_once('controllers/HomeController.php');

// Create a PDO instance for database connection
$dbConfig = DbConfig::getInstance();
$pdo = $dbConfig->getConnection();

// Create instances of the Model and Controller
$homeModel = new \projet2_Savoie\models\HomeModel($pdo);
$homeController = new \projet2_Savoie\controllers\HomeController($homeModel);

// Handle add-to-cart form submission
if (isset($_POST['action']) && $_POST['action'] == 'add_to_cart' && isset($_POST['product_id'])) {
    $userId = $_SESSION['user_id'] ?? null; 
    if ($userId) {
        $productId = $_POST['product_id'];
        $quantity = 1; // Adjust based on your form or business logic
        $homeController->addToCart($userId, $productId, $quantity);
    }
}
// Vérifier si les informations de l'utilisateur sont stockées dans la session
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $welcomeMessage = "Bonjour " . htmlspecialchars($user['fname']) . " " . htmlspecialchars($user['lname']);
} else {
    $welcomeMessage = "Bienvenue, visiteur!";
}

// Afficher le message de bienvenue
echo $welcomeMessage;
// Fetch the products
$products = $homeController->getLatestProducts();
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
                <a href="index.php?page=panier">
                    <img id="cart-icon" src="images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo count($_SESSION['panier'] ?? []); ?></span>
                </a>
            </div>
        </div>
    </header>

    <nav class="dark-nav">
        <ul>
            <li><a href="index.php?page=home">Accueil</a></li>
            <li><a href="index.php?page=inscription">Inscription</a></li>
            <li><a href="index.php?page=login">Connexion</a></li>
            <li><a href="index.php?page=panier">Panier</a></li>
            <?php if (isset($_SESSION['user'])): ?>
            <li><a href="index.php?page=deconnexion">Déconnexion</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1): ?>
            <li><a href="gestion.php">Gestion</a></li>
            <?php endif; ?>

        </ul>
    </nav>
<?php echo $welcomeMessage; ?>
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
                        <form method="post" action="index.php">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <input type="hidden" name="action" value="add_to_cart">
                            <button type="submit" name="submit">Ajouter au panier</button>
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
