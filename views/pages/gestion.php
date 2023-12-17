<?php
// Inclure les fichiers nécessaires pour la connexion à la base de données, modèles, contrôleurs, etc.
include_once('utils/DBConfig.php');
include_once('models/GestionModel.php');
include_once('controllers/GestionController.php');

// Démarrer la session et vérifier le rôle de l'utilisateur
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    // Rediriger l'utilisateur vers une autre page s'il n'est pas superAdmin
    header('Location: index.php');
    exit();
}

$dbConfig = DbConfig::getInstance();
$pdo = $dbConfig->getConnection();
$gestionModel = new \projet2_Savoie\Models\GestionModel($pdo);
$gestionController = new \projet2_Savoie\Controllers\GestionController($gestionModel);

// Traiter le formulaire d'ajout de produit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collecter et traiter les données du formulaire
    $productData = [
        'name' => $_POST['productName'],
        'price' => $_POST['productPrice'],
        'quantity' => $_POST['productQuantity'],
        'description' => $_POST['productDescription']
        // Ajoutez d'autres champs au besoin
    ];
    $gestionController->addProduct($productData);
}

// Récupérer l'historique des commandes
$orders = $gestionController->viewOrders();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des produits et commandes</title>
    <link rel="stylesheet" href="gestion.css">
</head>
<body>
    <div class="gestion-container">
        <h1>Gestion des Produits</h1>
        <form method="post" class="product-form">
            <label for="productName">Nom du produit:</label>
            <input type="text" id="productName" name="productName" placeholder="Nom du produit" required>

            <label for="productPrice">Prix:</label>
            <input type="number" id="productPrice" name="productPrice" placeholder="Prix" required>

            <label for="productQuantity">Quantité:</label>
            <input type="number" id="productQuantity" name="productQuantity" placeholder="Quantité" required>

            <label for="productDescription">Description:</label>
            <textarea id="productDescription" name="productDescription" placeholder="Description du produit" required></textarea>

            <button type="submit">Ajouter Produit</button>
        </form>

        <h2>Historique des Commandes</h2>
        <div class="order-history">
            <?php foreach ($orders as $order) : ?>
                <div class="order-item">
                    <!-- Afficher les détails de la commande ici -->
                    <p>Commande ID: <?php echo $order['id']; ?></p>
                    <p>Date: <?php echo $order['date']; ?></p>
                    <!-- Ajoutez d'autres détails de commande au besoin -->
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
