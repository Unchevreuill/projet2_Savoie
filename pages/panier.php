<?php
session_start();

// Vérifier si le panier existe dans la session, sinon le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Logique de suppression d'un produit du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['retirer_produit'])) {
    $index = $_POST['index_produit'];

    // Vérifier si l'index est valide
    if ($index >= 0 && $index < count($_SESSION['panier'])) {
        // Supprimer le produit du panier
        array_splice($_SESSION['panier'], $index, 1);
        // Rafraîchir la page pour refléter les changements
        header('Location: panier.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Teccart Wear</title>
    <link rel="stylesheet" href="../css/panier.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Panier</h1>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="../images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo count($_SESSION['panier']); ?></span>
                </a>
            </div>
        </div>
    </header>

    <!-- Ajout de la navbar de la page d'accueil -->
    <nav>
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
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
        // Vérifier si le panier est vide
        if (empty($_SESSION['panier'])) {
            echo '<p>Votre panier est vide.</p>';
        } else {
            // Afficher les produits du panier
            foreach ($_SESSION['panier'] as $index => $produit) {
                echo '<div class="product">';
                
                // Vérifier si la clé 'nom' existe avant de l'utiliser
                if (isset($produit['nom'])) {
                    echo '<h3>' . $produit['nom'] . '</h3>';
                } else {
                    echo '<h3>Produit sans nom</h3>';
                }
                
                // Vérifier si la clé 'prix' existe avant de l'utiliser
                if (isset($produit['prix'])) {
                    echo '<p>Prix : $' . number_format($produit['prix'], 2) . '</p>';
                } else {
                    echo '<p>Prix non disponible</p>';
                }

                // Vérifier si la clé 'image' existe et si le fichier image existe sur le serveur
                if (isset($produit['image']) && file_exists('../images/' . $produit['image'])) {
                    echo '<img src="../images/' . $produit['image'] . '" alt="' . $produit['nom'] . '">';
                } else {
                    echo '<p>Image non disponible</p>';
                }

                // Formulaire pour retirer le produit du panier
                echo '<form method="post" action="panier.php">';
                echo '<input type="hidden" name="index_produit" value="' . $index . '">';
                echo '<input type="submit" name="retirer_produit" value="Retirer du panier">';
                echo '</form>';

                echo '</div>';
            }
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
