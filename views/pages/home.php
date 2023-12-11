<?php
session_start();

// Inclure le fichier de configuration de la base de données
include_once('../../utils/DBConfig.php');

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

    // Ajouter le produit au panier
    $_SESSION['panier'][] = $productId;

    // Rafraîchir la page pour refléter les changements
    header('Location: home.php');
    exit();
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
                <div class="product"><br><br><br><br><br>
                    <img src="../../images/<?php echo $product['url_img']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Prix : $<?php echo $product['price']; ?></p>
                    <!-- Remplacez le commentaire par la description réelle -->
                    <p>Description : <?php echo "Chandail de musique"; ?></p>
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
