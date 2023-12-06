<?php

class IndexView {
    public function showHomePage($products) {
        // Display the home page with product listings
        echo '<div class="container">';
        
        echo '<h2>Welcome to Teccart Wear!</h2>';
        
        if (empty($products)) {
            echo '<p>No products available.</p>';
        } else {
            foreach ($products as $product) {
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
                echo '<input type="hidden" name="product_id" value="' . $product['id'] . '">';
                echo '<input type="submit" name="buy_now" value="Buy Now">';
                echo '</form>';

                echo '</div>';
            }
        }
        
        echo '</div>';
    }
}
