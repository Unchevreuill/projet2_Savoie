<?php
namespace projet2_Savoie\Views;

// class HomeView
// {
//     // This method renders the home page with a list of products
//     public function renderHome($products)
//     {
//         echo '<main>';
//         echo '<div class="new-products">';
//         echo '<h2>Nouveaux Produits</h2>';

//         // Check if there are products to display
//         if (!empty($products)) {
//             foreach ($products as $product) {
//                 echo '<div class="product">';
//                 echo '<img src="images/' . htmlspecialchars($product['url_img']) . '" alt="' . htmlspecialchars($product['name']) . '">';
//                 echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
//                 echo '<p>Prix : $' . htmlspecialchars($product['price']) . '</p>';
//                 echo '<form method="post" action="home.php">';
//                 echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($product['id']) . '">';
//                 echo '<button type="submit" name="add_to_cart">Ajouter au panier</button>';
//                 echo '</form>';
//                 echo '</div>';
//             }
//         } else {
//             echo '<p>Aucun produit n\'est disponible pour le moment.</p>';
//         }

//         echo '</div>';
//         echo '</main>';
//     }

//     // Additional methods for other parts of the site can be added here
//     // For example, renderProductDetails, renderCart, etc.
// }
// ?>
