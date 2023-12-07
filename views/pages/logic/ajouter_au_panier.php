<?php
session_start();
include_once('../db_connect.php');

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
    
    try {
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le produit existe
        if ($product) {
            // Ajouter le produit au panier
            $_SESSION['panier'][] = array(
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['url_img']
            );

            // Rediriger vers la page d'accueil avec un message de succès
            header('Location: ../index.php?success=produit_ajoute');
            exit();
        } else {
            // Rediriger vers la page d'accueil avec un message d'erreur si le produit n'est pas trouvé
            header('Location: ../index.php?error=produit_non_trouve');
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur lors de l'exécution de la requête
        echo "Erreur : " . $e->getMessage();
    }
} else {
    // Rediriger vers la page d'accueil si aucune donnée de formulaire n'a été reçue
    header('Location: ../index.php');
    exit();
}
?>
