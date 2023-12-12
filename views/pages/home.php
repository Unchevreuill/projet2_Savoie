<?php
session_start();

include_once('../../utils/DBConfig.php');
include_once('../../models/HomeModel.php');

// Créer une instance de la classe DbConfig
$dbConfig = new DbConfig();
$pdo = $dbConfig->getConnection();

// Vérifier si la connexion à la base de données est établie
if ($pdo) {
    // Récupérer les trois derniers produits de la base de données
    $query = $pdo->query("SELECT * FROM product ORDER BY id DESC LIMIT 3");

    if ($query) {
        $latestProducts = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Erreur de requête SQL";
        exit;
    }
} else {
    echo "Erreur de connexion à la base de données";
    exit;
}

// Vérifier si la variable de session 'panier' n'existe pas encore
if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Gérer l'ajout d'un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];

    // Créez une nouvelle commande (user_order) et récupérez son ID
    $orderDate = date('Y-m-d H:i:s'); 
    $total = 0;

    // Vérifiez si l'utilisateur est connecté et obtenez son ID depuis la session
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

    // Créez une instance de la classe HomeModel
    $homeModel = new \projet2_Savoie\Models\HomeModel($pdo);

    // Insérez la commande dans la table user_order
    $insertOrderQuery = $pdo->prepare("INSERT INTO user_order (ref, order_date, total, user_id) VALUES (:ref, :order_date, :total, :user_id)");
    $ref = $homeModel->generateOrderReference(); 
    $insertOrderQuery->bindParam(':ref', $ref);
    $insertOrderQuery->bindParam(':order_date', $orderDate);
    $insertOrderQuery->bindParam(':total', $total);
    $insertOrderQuery->bindParam(':user_id', $userId);

    if ($insertOrderQuery->execute()) {
        $orderId = $pdo->lastInsertId();

        // Ajoutez le produit au panier dans la table order_has_product
        $insertProductQuery = $pdo->prepare("INSERT INTO order_has_product (user_order_id, product_id, qtty, price) VALUES (:user_order_id, :product_id, :qtty, :price)");
        $insertProductQuery->bindParam(':user_order_id', $orderId);
        $insertProductQuery->bindParam(':product_id', $productId);
        $quantity = 1; 
        $price = $homeModel->getProductPrice($productId); 
        $insertProductQuery->bindParam(':qtty', $quantity);
        $insertProductQuery->bindParam(':price', $price);

        if ($insertProductQuery->execute()) {
            header('Location: home.php');
            exit();
        } else {
            echo "Erreur lors de l'ajout au panier";
        }
    } else {
        echo "Erreur lors de la création de la commande";
    }
}

// Afficher un message de bienvenue si l'utilisateur est connecté
$welcomeMessage = "Bienvenue visiteur !";
if (isset($_SESSION['user'])) {
    $welcomeMessage = "Bonjour " . htmlspecialchars($_SESSION['user']['fname']) . " " . htmlspecialchars($_SESSION['user']['lname']) . " !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Accueil</title>
    <link rel="stylesheet" href="../../css/home.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="welcome-message">
                <?php echo $welcomeMessage; ?>
            </div>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="../../images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo count($_SESSION['panier']); ?></span>
                </a>
            </div>
        </div>
    </header>
    <nav class="dark-nav">
        <ul>
            <li><a href="home.php">Accueil</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="login.php">Connexion</a></li>
            <li><a href="panier.php">Panier</a></li>
            <?php if (isset($_SESSION['user'])): ?>
            <li><a href="deconnexion.php">Déconnexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <main>
        <div class="new-products">
            <h2>Nouveaux Produits</h2>
            <?php foreach ($latestProducts as $product): ?>
                <div class="product">
                    <img src="../../images/<?php echo $product['url_img']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Prix : $<?php echo $product['price']; ?></p>
                    <p>Description : <?php echo $product['description']; ?></p>
                    <form method="post" action="home.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="add_to_cart">Ajouter au panier</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
