<?php

namespace projet2_Savoie\Models;
include_once('utils/DBConfig.php'); 
use PDO;
use PDOException;
use PDORow;

class HomeModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Retrieve all products from the database
    public function getAllProducts()
    {
        $query = $this->db->query("SELECT * FROM product");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retrieve product details by ID
    public function getProductDetails($productId)
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE id = :product_id");
        $query->bindParam(':product_id', $productId);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
    public function getLatestProducts()
    {
        $query = $this->db->query("SELECT * FROM product ORDER BY id DESC LIMIT 3");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($userId, $productId, $quantity)
    {
        try {
            // Check if the product is already in the user's cart
            $existingCartQuery = $this->db->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
            $existingCartQuery->bindParam(':user_id', $userId);
            $existingCartQuery->bindParam(':product_id', $productId);
            $existingCartQuery->execute();
            $existingCartItem = $existingCartQuery->fetch(PDO::FETCH_ASSOC);
    
            if ($existingCartItem) {
                // If the product is already in the cart, update the quantity
                $newQuantity = $existingCartItem['quantity'] + $quantity;
                $updateCartQuery = $this->db->prepare("UPDATE cart SET quantity = :quantity WHERE id = :cart_id");
                $updateCartQuery->bindParam(':quantity', $newQuantity);
                $updateCartQuery->bindParam(':cart_id', $existingCartItem['id']);
                $updateCartQuery->execute();
            } else {
                // If the product is not in the cart, add it as a new item
                $insertCartQuery = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
                $insertCartQuery->bindParam(':user_id', $userId);
                $insertCartQuery->bindParam(':product_id', $productId);
                $insertCartQuery->bindParam(':quantity', $quantity);
                $insertCartQuery->execute();
            }
    
            return true; // Successfully added to cart
        } catch (PDOException $e) {
            return false; // Failed to add to cart
        }
    }
    // Retrieve the user's cart
    public function getUserCart($userId)
    {

        $query = $this->db->prepare("SELECT product.* FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = :user_id");
        $query->bindParam(':user_id', $userId);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Calculate the total price of the user's cart
    public function calculateCartTotal($userId)
    {
        $query = $this->db->prepare("SELECT SUM(product.price) AS total_price FROM cart INNER JOIN product ON cart.product_id = product.id WHERE cart.user_id = :user_id");
        $query->bindParam(':user_id', $userId);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return $result['total_price'] ?? 0;
    }

    // Generate a random order reference
    public function generateOrderReference()
    {
        // Generate a random alphanumeric string of a specified length
        $length = 8;
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $reference = '';

        for ($i = 0; $i < $length; $i++) {
            $reference .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $reference;
    }

}
