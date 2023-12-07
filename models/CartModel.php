<?php

namespace projet2_Savoie\Models;

use PDO;

class CartModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Obtient le contenu actuel du panier
    public function getCartContents()
    {
        $userId = $_SESSION['user_id'];
        
        // Sélectionnez les produits du panier pour l'utilisateur actuel
        $query = $this->db->prepare("SELECT p.id, p.name, p.price, p.url_img, o.qtty FROM product p
                                     INNER JOIN order_has_product o ON p.id = o.product_id
                                     INNER JOIN user_order uo ON o.user_order_id = uo.id
                                     WHERE uo.user_id = :userId");

        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajoute un produit au panier
    public function addToCart($productId, $quantity)
    {
        $userId = $_SESSION['user_id'];

        // Vérifiez d'abord si le produit existe déjà dans le panier de l'utilisateur
        $existingProduct = $this->db->prepare("SELECT * FROM order_has_product
                                              WHERE user_order_id = (SELECT id FROM user_order WHERE user_id = :userId AND order_date IS NULL)
                                              AND product_id = :productId");

        $existingProduct->bindParam(':userId', $userId, PDO::PARAM_INT);
        $existingProduct->bindParam(':productId', $productId, PDO::PARAM_INT);
        $existingProduct->execute();

        $result = $existingProduct->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Le produit existe déjà, mettez à jour la quantité
            $updateQuery = $this->db->prepare("UPDATE order_has_product
                                              SET qtty = qtty + :quantity
                                              WHERE user_order_id = (SELECT id FROM user_order WHERE user_id = :userId AND order_date IS NULL)
                                              AND product_id = :productId");

            $updateQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
            $updateQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
            $updateQuery->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            
            return $updateQuery->execute();
        } else {
            // Le produit n'existe pas encore dans le panier, ajoutez-le
            $insertQuery = $this->db->prepare("INSERT INTO order_has_product (user_order_id, product_id, qtty)
                                               VALUES ((SELECT id FROM user_order WHERE user_id = :userId AND order_date IS NULL), :productId, :quantity)");

            $insertQuery->bindParam(':userId', $userId, PDO::PARAM_INT);
            $insertQuery->bindParam(':productId', $productId, PDO::PARAM_INT);
            $insertQuery->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            
            return $insertQuery->execute();
        }
    }

    // Supprime un produit du panier
    public function removeProductFromCart($productId)
    {
        $userId = $_SESSION['user_id'];

        // Supprimez le produit du panier
        $query = $this->db->prepare("DELETE FROM order_has_product
                                     WHERE user_order_id = (SELECT id FROM user_order WHERE user_id = :userId AND order_date IS NULL)
                                     AND product_id = :productId");

        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->bindParam(':productId', $productId, PDO::PARAM_INT);

        return $query->execute();
    }

    // Vide complètement le panier
    public function clearCart()
    {
        $userId = $_SESSION['user_id'];

        // Supprimez tous les produits du panier
        $query = $this->db->prepare("DELETE FROM order_has_product
                                     WHERE user_order_id = (SELECT id FROM user_order WHERE user_id = :userId AND order_date IS NULL)");

        $query->bindParam(':userId', $userId, PDO::PARAM_INT);

        return $query->execute();
    }
}
