<?php

class CartModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addToCart($product_id) {
        // Retrieve product details from the database based on $product_id
        $productDetails = $this->getProductDetails($product_id);

        // Check if the product exists
        if ($productDetails) {
            // Add the product to the user's cart
            $_SESSION['cart'][] = [
                'id' => $productDetails['id'],
                'name' => $productDetails['name'],
                'price' => $productDetails['price'],
                'image' => $productDetails['url_img']
            ];

            return true; // Addition to cart successful
        } else {
            return false; // Product not found
        }
    }

    public function getProductDetails($product_id) {
        // Query to retrieve product details from the database based on $product_id
        $query = "SELECT * FROM product WHERE id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
