<?php

namespace projet2_Savoie\Views;

class ProductView
{
    public function renderAllProducts(array $products)
    {
        // Implement logic to render all products
        foreach ($products as $product) {
            echo "<div class='product'>";
            echo "<h2>{$product['name']}</h2>";
            echo "<p>{$product['description']}</p>";
            echo "<p>Price: ${$product['price']}</p>";
            // Add a form or link to allow adding to cart or viewing details
            echo "<form method='post' action='/add-to-cart/{$product['id']}'>";
            echo "<input type='submit' value='Add to Cart'>";
            echo "</form>";
            echo "</div>";
        }
    }

    public function renderProductDetails(array $productDetails)
    {
        // Implement logic to render product details
        echo "<div class='product-details'>";
        echo "<h2>{$productDetails['name']}</h2>";
        echo "<p>{$productDetails['description']}</p>";
        echo "<p>Price: ${$productDetails['price']}</p>";
        // Add more details as needed
        echo "<form method='post' action='/add-to-cart/{$productDetails['id']}'>";
        echo "<input type='submit' value='Add to Cart'>";
        echo "</form>";
        echo "</div>";
    }
}
