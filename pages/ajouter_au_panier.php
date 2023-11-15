<?php
session_start();

// Vérifier si le panier existe dans la session, sinon le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Vérifier si un produit a été sélectionné
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acheter']) && isset($_POST['index_produit'])) {
    // Récupérer l'index du produit depuis le formulaire
    $index = $_POST['index_produit'];

    // Exemple de produits (à remplacer par votre logique d'ajout de produits)
    $produits = array(
        array('nom' => 'Chemise Élégante', 'prix' => 29.99),
        array('nom' => 'Robe d\'Été', 'prix' => 39.99),
        array('nom' => 'Jeans Classiques', 'prix' => 49.99)
    );

    // Vérifier si l'index est valide
    if ($index >= 0 && $index < count($produits)) {
        // Ajouter le produit au panier
        $produit = $produits[$index];
        array_push($_SESSION['panier'], $produit);

        // Rediriger vers la page d'accueil après l'ajout au panier
        header('Location: ../pages/accueil.php');
        exit();
    } else {
        // Rediriger vers la page d'accueil si l'index n'est pas valide
        header('Location: ../pages/accueil.php');
        exit();
    }
} else {
    // Rediriger vers la page d'accueil si aucune donnée de formulaire n'a été reçue
    header('Location: ../pages/accueil.php');
    exit();
}
?>
