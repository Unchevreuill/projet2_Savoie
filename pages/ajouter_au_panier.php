<?php
session_start();
include_once('../db_connect.php'); // Assurez-vous d'avoir un fichier de connexion à la base de données approprié

// Vérifier si le panier existe dans la session, sinon le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Vérifier si un produit a été sélectionné
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acheter']) && isset($_POST['product_id'])) {
    // Récupérer l'ID du produit depuis le formulaire
    $product_id = $_POST['product_id'];

    // Récupérer les informations du produit depuis la base de données
    $query = "SELECT * FROM product WHERE id = :product_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le produit existe
    if ($product) {
        // Ajouter le produit au panier
        array_push($_SESSION['panier'], $product);

        // Rediriger vers la page d'accueil après l'ajout au panier
        header('Location: ../pages/accueil.php');
        exit();
    } else {
        // Rediriger vers la page d'accueil si le produit n'est pas trouvé
        header('Location: ../pages/accueil.php');
        exit();
    }
} else {
    // Rediriger vers la page d'accueil si aucune donnée de formulaire n'a été reçue
    header('Location: ../pages/accueil.php');
    exit();
}
?>
