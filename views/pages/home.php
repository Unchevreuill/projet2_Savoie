<?php
session_start(); // Démarrez la session si elle n'a pas encore été démarrée

include_once('../../utils/DbConfig.php');

// Créer une instance de la classe DbConfig
$dbConfig = new DbConfig();

// Obtenir l'objet PDO
$pdo = $dbConfig->getConnection();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Accueil</title>
  
    <link rel="stylesheet" href="../css/home.css"> 
</head>

<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="../images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0; ?></span>
                </a>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="home.php">Accueil</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="login.php">Connexion</a></li>
            <li><a href="panier.php">Panier</a></li>
        </ul>
    </nav>

    <main>
        <div class="banner">
            <img src="../images/banner.jpg" alt="Bannière">
        </div>

        <div class="new-products">
            <h2>Nouveaux Produits</h2>

            <?php foreach ($latestProducts as $product): ?>
                <div class="product">
                    <img src="../images/<?php echo $product['url_img']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p>Prix : $<?php echo $product['price']; ?></p>
                    <!-- Remplacez le commentaire par la description réelle -->
                    <p>Description : <?php echo "Description du produit"; ?></p>
                    <button onclick="addToCart(<?php echo $product['id']; ?>)">Ajouter au panier</button>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Teccart Wear. Tous droits réservés.</p>
    </footer>

    <script>
        function addToCart(productId) {
            // Ajoutez la logique pour ajouter le produit au panier, si nécessaire
            console.log('Produit ajouté au panier : ' + productId);
        }
    </script>
</body>

</html>
