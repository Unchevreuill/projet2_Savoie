<?php
session_start();

// Exemple de produits
$produits = array(
    array('nom' => 'Chemise Élégante', 'prix' => 29.99, 'image' => '../images/chemise.jpg'),
    array('nom' => 'Robe d\'Été', 'prix' => 39.99, 'image' => '../images/robe.jpg'),
    array('nom' => 'Jeans Classiques', 'prix' => 49.99, 'image' => '../images/jeans.jpg'),
    // Ajoutez d'autres produits selon le même format
);

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
    <link rel="stylesheet" href="../css/accueil.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="../images/cart-icon.png" alt="Panier">
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
            <a href="inscription.php">Inscription</a>
            <a href="login.php">Connexion</a>
        </div>
    </nav>
    
    <div class="container">
        <?php
        // Afficher les produits
        foreach ($produits as $index => $produit) {
            echo '<div class="product">';
            echo '<img src="' . $produit['image'] . '" alt="' . $produit['nom'] . '">';
            echo '<h3>' . $produit['nom'] . '</h3>';
            echo '<p>Prix : $' . number_format($produit['prix'], 2) . '</p>';
            echo '<form method="post" action="accueil.php">';
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
