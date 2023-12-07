<?php

namespace projet2_Savoie\Models;

use PDO;

class ProductModel
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

    public function getProductDetails($productId)
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE id = :productId");
        $query->bindParam(':productId', $productId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addToCart($productId)
    {
        // Implémentez votre logique pour ajouter le produit au panier ici
        // Assurez-vous d'adapter cette logique en fonction de votre structure de base de données
        // Vous pouvez également gérer les erreurs et les succès en conséquence

        // Exemple de requête pour ajouter un produit au panier
        $query = $this->db->prepare("INSERT INTO order_has_product (user_order_id, product_id, qtty, price) 
                                    VALUES (:orderId, :productId, :quantity, :price)");

        $orderId = $this->getUserOrderId(); // À adapter en fonction de votre logique
        $quantity = 1; // À adapter en fonction de votre logique
        $price = $this->getProductPrice($productId); // À adapter en fonction de votre logique

        $query->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $query->bindParam(':productId', $productId, PDO::PARAM_INT);
        $query->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $query->bindParam(':price', $price, PDO::PARAM_INT);

        return $query->execute();
    }

    private function getUserOrderId()
    {
        // Implémentez votre logique pour obtenir l'ID de commande de l'utilisateur ici
        // Cette méthode dépend de votre application
    }

    private function getProductPrice($productId)
    {
        $query = $this->db->prepare("SELECT price FROM product WHERE id = :productId");
        $query->bindParam(':productId', $productId, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        return ($result) ? $result['price'] : 0;
    }
}
