<?php
namespace projet2_Savoie\Views;

class HomeView
{
    public function renderHome()
    {
        // Affichez ici le contenu de votre page d'accueil
        echo '<h1>Bienvenue sur Teccart Wear</h1>';
        echo '<p>Explorez notre collection exclusive de vêtements.</p>';
        // Ajoutez d'autres éléments de votre page d'accueil

        // Exemple de lien vers la page de produits
        echo '<a href="products.php">Voir les produits</a>';
    }

    public function renderProductDetails($productDetails)
    {
        // Affichez ici les détails du produit
        echo '<h2>Détails du produit</h2>';
        echo '<p>Nom: ' . $productDetails['name'] . '</p>';
        echo '<p>Description: ' . $productDetails['description'] . '</p>';
        echo '<p>Prix: $' . $productDetails['price'] . '</p>';
      
    }


}
