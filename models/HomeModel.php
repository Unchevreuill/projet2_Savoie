<?php

namespace projet2_Savoie\Models;
include_once('utils/DBConfig.php'); 
use PDO;
use PDOException;
use PDORow;

class HomeModel
{
    public $db;

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

    public function addToCart($userId, $productId, $quantity) {
        try {
            // Fetch or create an order ID for the current user
            $orderId = $this->getOrCreateUserOrder($userId);
    
            // Check if the product is already in the user's order
            $existingOrderProductQuery = $this->db->prepare("SELECT * FROM order_has_product WHERE order_id = :order_id AND product_id = :product_id");
            $existingOrderProductQuery->bindParam(':order_id', $orderId);
            $existingOrderProductQuery->bindParam(':product_id', $productId);
            $existingOrderProductQuery->execute();
            $existingOrderProduct = $existingOrderProductQuery->fetch(PDO::FETCH_ASSOC);
    
            if ($existingOrderProduct) {
                // Update the quantity if the product is already in the order
                $newQuantity = $existingOrderProduct['quantity'] + $quantity;
                $updateOrderProductQuery = $this->db->prepare("UPDATE order_has_product SET quantity = :quantity WHERE id = :id");
                $updateOrderProductQuery->bindParam(':quantity', $newQuantity);
                $updateOrderProductQuery->bindParam(':id', $existingOrderProduct['id']);
                $updateOrderProductQuery->execute();
            } else {
                // Insert a new product into the order
                $insertOrderProductQuery = $this->db->prepare("INSERT INTO order_has_product (order_id, product_id, quantity) VALUES (:order_id, :product_id, :quantity)");
                $insertOrderProductQuery->bindParam(':order_id', $orderId);
                $insertOrderProductQuery->bindParam(':product_id', $productId);
                $insertOrderProductQuery->bindParam(':quantity', $quantity);
                $insertOrderProductQuery->execute();
            }
    
            return true;
        } catch (PDOException $e) {
            // Log error and return false
            error_log("Error in addToCart: " . $e->getMessage());
            return false;
        }
    }
    public function getOrCreateUserOrder($userId) {
        try {
            // Check if there's an existing order for this user
            $orderQuery = $this->db->prepare("SELECT id FROM user_order WHERE user_id = :user_id AND status = 'open'");
            $orderQuery->bindParam(':user_id', $userId);
            $orderQuery->execute();
            $order = $orderQuery->fetch(PDO::FETCH_ASSOC);
    
            if ($order) {
                // Return the existing order ID
                return $order['id'];
            } else {
                // Create a new order and return its ID
                $insertOrderQuery = $this->db->prepare("INSERT INTO user_order (user_id, status, created_at) VALUES (:user_id, 'open', NOW())");
                $insertOrderQuery->bindParam(':user_id', $userId);
                $insertOrderQuery->execute();
    
                return $this->db->lastInsertId(); // Assuming your DB driver supports this method
            }
        } catch (PDOException $e) {
            // Handle exception (log error, etc.)
            error_log("Error in getOrCreateUserOrder: " . $e->getMessage());
            return null; // Indicate failure
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
