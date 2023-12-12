<?php

namespace projet2_Savoie\Models;

use PDO;

class HomeModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Récupérer tous les produits
    public function getAllProducts()
    {
        $query = $this->db->query("SELECT * FROM product");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les produits vedettes
    public function getFeaturedProducts()
    {
        $query = $this->db->query("SELECT * FROM product WHERE featured = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductPrice($productId)
    {
        $query = $this->db->prepare("SELECT price FROM product WHERE id = :product_id");
        $query->bindParam(':product_id', $productId);
        $query->execute();
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        if ($result && isset($result['price'])) {
            return $result['price'];
        } else {
            // Retournez un prix par défaut
            return 0;
        }
    }
    public function generateOrderReference()
    {
        // Générez une chaîne aléatoire de 8 caractères
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $length = 8;
        $reference = '';
    
        for ($i = 0; $i < $length; $i++) {
            $reference .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $reference;
    }
}
