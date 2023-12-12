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

    // Vérifier si la requête a réussi
    if ($query) {
        $latestProducts = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Gérer l'erreur de la requête SQL
        echo "Erreur de requête SQL";
        exit;
    }
} else {
    // Gérer l'erreur de la connexion à la base de données
    echo "Erreur de connexion à la base de données";
    exit;
}

// Vérifier si la variable de session 'panier' n'existe pas encore
if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
    // Initialiser le panier comme un tableau vide
    $_SESSION['panier'] = [];
}

// Gérer l'ajout d'un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];

    // Créez une nouvelle commande (user_order) et récupérez son ID
    $orderDate = date('Y-m-d H:i:s'); 
    $total = 0;

    // Vérifiez si l'utilisateur est connecté et obtenez son ID depuis la session
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } else {
        // Utilisateur non connecté, définissez l'ID par défaut à 1
        $userId = 1;
    }

    // Créez une instance de la classe HomeModel
    $homeModel = new \projet2_Savoie\Models\HomeModel($pdo);


    // Insérez la commande dans la table user_order
    $insertOrderQuery = $pdo->prepare("INSERT INTO user_order (ref, order_date, total, user_id) VALUES (:ref, :order_date, :total, :user_id)");
    $ref = $homeModel->generateOrderReference(); // Utilisez la fonction generateOrderReference de HomeModel
    $insertOrderQuery->bindParam(':ref', $ref);
    $insertOrderQuery->bindParam(':order_date', $orderDate);
    $insertOrderQuery->bindParam(':total', $total);
    $insertOrderQuery->bindParam(':user_id', $userId);

    if ($insertOrderQuery->execute()) {
        // Récupérez l'ID de la commande nouvellement créée
        $orderId = $pdo->lastInsertId();

        // Ajoutez le produit au panier dans la table order_has_product
        $insertProductQuery = $pdo->prepare("INSERT INTO order_has_product (user_order_id, product_id, qtty, price) VALUES (:user_order_id, :product_id, :qtty, :price)");
        $insertProductQuery->bindParam(':user_order_id', $orderId);
        $insertProductQuery->bindParam(':product_id', $productId);
        $quantity = 1; // Vous pouvez ajuster la quantité en fonction de votre logique
        $price = $homeModel->getProductPrice($productId); // Utilisez la fonction getProductPrice de HomeModel
        $insertProductQuery->bindParam(':qtty', $quantity);
        $insertProductQuery->bindParam(':price', $price);

        if ($insertProductQuery->execute()) {
            // Rafraîchir la page pour refléter les changements
            header('Location: home.php');
            exit();
        } else {
            // Gérer l'erreur d'insertion dans la table order_has_product
            echo "Erreur lors de l'ajout au panier";
        }
    } else {
        // Gérer l'erreur d'insertion dans la table user_order
        echo "Erreur lors de la création de la commande";
    }
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
                    <!-- Remplacez le commentaire par la description réelle -->
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
