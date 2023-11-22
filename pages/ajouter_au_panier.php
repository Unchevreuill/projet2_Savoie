<?php
session_start();
<<<<<<< HEAD
include_once('../db_connect.php'); 
=======
include_once('./projet2_Savoie/db_connect.php'); 
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f

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
        header('Location: ../index.php');
        exit();
    } else {
        // Rediriger vers la page d'accueil si le produit n'est pas trouvé
<<<<<<< HEAD
        header('Location: ../index.php');
=======
        header('Location: ../pages/accueil.php');
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f
        exit();
    }
} else {
    // Rediriger vers la page d'accueil si aucune donnée de formulaire n'a été reçue
    header('Location: ../index.php');
    exit();
}
?>
