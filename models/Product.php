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
        $query = $this->db->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
        $query->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $query->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $query->bindValue(':quantity', 1, PDO::PARAM_INT); // Assuming you're adding one product
        return $query->execute();
    }

    public function getProductDetails($productId)
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $query->bindParam(':id', $productId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
