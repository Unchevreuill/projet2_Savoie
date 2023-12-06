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

// Inclure le fichier de connexion à la base de données
include_once('../db_connect.php');
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
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="../images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo count($_SESSION['panier']); ?></span>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <?php
        // Vérifier si le panier est vide
        if (empty($_SESSION['panier'])) {
            echo '<p>Votre panier est vide.</p>';
        } else {
            // Initialiser le montant total
            $total = 0;

            // Afficher les produits du panier
            foreach ($_SESSION['panier'] as $index => $produit) {
                echo '<div class="product">';

                // Vérifier si la clé 'nom' existe et n'est pas vide
                if (isset($produit['nom']) && !empty($produit['nom'])) {
                    echo '<h3>' . $produit['nom'] . '</h3>';
                } else {
                    echo '<h3>Produit sans nom</h3>';
                }


                // Vérifier si la clé 'prix' existe et n'est pas vide
                if (isset($produit['prix']) && !empty($produit['prix'])) {
                    echo '<p>Prix : $' . number_format($produit['prix'], 2) . '</p>';
                    // Ajouter le prix au total
                    $total += $produit['prix'];
                } else {
                    echo '<p>Prix non disponible</p>';
                }

                // Vérifier si la clé 'image' existe et n'est pas vide
                if (isset($produit['image']) && !empty($produit['image'])) {
                    // Afficher l'image à partir du dossier images
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

            // Afficher le montant total, les taxes et le montant final
            $taxes = $total * 0.15;
            $montantFinal = $total + $taxes;

            echo '<div class="total">';
            echo '<p>Montant avant taxes : $' . number_format($total, 2) . '</p>';
            echo '<p>Taxes (15%) : $' . number_format($taxes, 2) . '</p>';
            echo '<p>Montant final : $' . number_format($montantFinal, 2) . '</p>';
            echo '</div>';
        }
        ?>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>

</html>