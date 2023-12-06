<?php

class CartView {
    public function showCart($cartItems, $total, $taxes, $finalAmount) {
        // Display the cart items, total, taxes, and final amount
        echo '<div class="container">';
        
        if (empty($cartItems)) {
            echo '<p>Your cart is empty.</p>';
        } else {
            foreach ($cartItems as $index => $product) {
                echo '<div class="product">';
                
                if (isset($product['name']) && !empty($product['name'])) {
                    echo '<h3>' . $product['name'] . '</h3>';
                } else {
                    echo '<h3>Product without name</h3>';
                }
                
                if (isset($product['price']) && !empty($product['price'])) {
                    echo '<p>Price: $' . number_format($product['price'], 2) . '</p>';
                } else {
                    echo '<p>Price not available</p>';
                }

                if (isset($product['image']) && file_exists('../images/' . $product['image'])) {
                    echo '<img src="../images/' . $product['image'] . '" alt="' . $product['name'] . '">';
                } else {
                    echo '<p>Image not available</p>';
                }

                echo '<form method="post" action="panier.php">';
                echo '<input type="hidden" name="index_produit" value="' . $index . '">';
                echo '<input type="submit" name="remove_product" value="Remove from cart">';
                echo '</form>';

                echo '</div>';
            }

            echo '<div class="total">';
            echo '<p>Total before taxes: $' . number_format($total, 2) . '</p>';
            echo '<p>Taxes (15%): $' . number_format($taxes, 2) . '</p>';
            echo '<p>Final amount: $' . number_format($finalAmount, 2) . '</p>';
            echo '</div>';
        }
        
        echo '</div>';
    }
}
