<?php
session_start();

// Inclure le fichier de connexion à la base de données
include_once('./db_connect.php');

// Récupérer les produits depuis la base de données
$query = "SELECT * FROM product";
$stmt = $pdo->query($query);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le panier existe dans la session, sinon le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Vérifier si un produit a été ajouté au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acheter']) && isset($_POST['index_produit'])) {
    $index = $_POST['index_produit'];
    // Ajouter le produit au panier
    array_push($_SESSION['panier'], $produits[$index]);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Accueil</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="./pages/panier.php">
                    <img id="cart-icon" src="./images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo count($_SESSION['panier']); ?></span>
                </a>
            </div>
        </div>
    </header>
    
    <nav>
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Femmes</a></li>
            <li><a href="#">Hommes</a></li>
            <li><a href="#">Enfants</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="login-button">
            <a href="../pages/login.php">Connexion</a>
        </div>
    </nav>
    
    <div class="container">
        <?php
        // Afficher les produits
        foreach ($produits as $index => $produit) {
            echo '<div class="product">';
            // Vérifier si la clé 'url_img' existe avant de l'utiliser
            if (isset($produit['url_img'])) {
                echo '<img src="../projet2_Savoie/images/' . $produit['url_img'] . '" alt="' . $produit['name'] . '">';



            } else {
                echo '<p>Image non disponible</p>';
            }
            echo '<h3>' . $produit['name'] . '</h3>';
            echo '<p>Prix : $' . number_format($produit['price'], 2) . '</p>';
            echo '<form method="post" action="index.php">';
            echo '<input type="hidden" name="index_produit" value="' . $index . '">';
            echo '<input type="submit" name="acheter" value="Acheter">';
            echo '</form>';
            echo '</div>';
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
