<?php

namespace projet2_Savoie\Models;

use PDO;

class Product
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllProducts()
    {
        $query = $this->db->query("SELECT * FROM product");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($productId)
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $query->bindParam(':id', $productId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart($productId)
    {
        // You need to implement this method based on your cart logic
        // For example, you might want to insert a record into a 'cart' table
        // with the user_id, product_id, and quantity.

        // Sample code assuming there is a 'cart' table:
        $query = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $query->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $query->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $query->bindValue(':quantity', 1, PDO::PARAM_INT); // Assuming you're adding one product
        return $query->execute();
    }

    public function getProductDetails($productId)
    {
        // You need to implement this method to get detailed information about a product
        // For example, you might want to retrieve additional details from the 'product' table.

        $query = $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $query->bindParam(':id', $productId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
