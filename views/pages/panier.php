<?php
session_start();

// Inclure le fichier de configuration de la base de données
include_once('../../utils/DBConfig.php');

// Inclure la classe CartModel
include_once('../../Models/CartModel.php');

// Créer une instance de la classe DbConfig
$dbConfig = new DbConfig();
$pdo = $dbConfig->getConnection();

// Vérifier si la connexion à la base de données est établie
if (!$pdo) {
    echo "Erreur de connexion à la base de données";
    exit;
}

// Créer une instance de CartModel
$cartModel = new \projet2_Savoie\Models\CartModel($pdo);

// Vérifier si la variable de session 'panier' n'existe pas encore
if (!isset($_SESSION['panier'])) {
    // Initialiser le panier comme un tableau vide
    $_SESSION['panier'] = [];
}

// Gérer l'ajout d'un produit au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = 1; // Vous pouvez ajuster la quantité en fonction de votre logique

    // Ajouter le produit au panier via le modèle CartModel
    $cartModel->addToCart($productId, $quantity);

    // Rafraîchir la page pour refléter les changements
    header('Location: panier.php');
    exit();
}

// Gérer la suppression d'un produit du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];

    // Supprimer le produit du panier via le modèle CartModel
    $cartModel->removeProductFromCart($productId);

    // Rafraîchir la page pour refléter les changements
    header('Location: panier.php');
    exit();
}

// Gérer la suppression complète du panier
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clear_cart'])) {
    // Vider complètement le panier via le modèle CartModel
    $cartModel->clearCart();

    // Rafraîchir la page pour refléter les changements
    header('Location: panier.php');
    exit();
}

// Obtenir le contenu actuel du panier via le modèle CartModel
$cartContents = $cartModel->getCartContents();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Panier</title>
    <link rel="stylesheet" href="../../css/panier.css"> <!-- Assurez-vous d'ajuster le chemin du fichier CSS en fonction de votre structure -->
</head>

<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="../../images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo isset($_SESSION['panier']) && is_array($_SESSION['panier']) ? count($_SESSION['panier']) : 0; ?></span>
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
        <h2>Panier</h2>

        <?php if (empty($cartContents)) : ?>
            <p>Votre panier est vide.</p>
        <?php else : ?>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Sous-total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartContents as $cartItem) : ?>
                        <tr>
                            <td>
                                <img src="../../images/<?php echo $cartItem['url_img']; ?>" alt="<?php echo $cartItem['name']; ?>">
                                <p><?php echo $cartItem['name']; ?></p>
                            </td>
                            <td>$<?php echo $cartItem['price']; ?></td>
                            <td><?php echo $cartItem['qtty']; ?></td>
                            <td>$<?php echo $cartItem['price'] * $cartItem['qtty']; ?></td>
                            <td>
                                <form method="post" action="panier.php">
                                    <input type="hidden" name="product_id" value="<?php echo $cartItem['id']; ?>">
                                    <button type="submit" name="remove_from_cart">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>$<?php echo array_sum(array_column($cartContents, 'price')) ?></td>
                        <td>
                            <form method="post" action="panier.php">
                                <button type="submit" name="clear_cart">Vider le panier</button>
                            </form>
                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>

</html>
