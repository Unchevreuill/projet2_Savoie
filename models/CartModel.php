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

    public function getCartContents() {
        if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])) {
            $productIds = array_keys($_SESSION['panier']);
            $placeholders = implode(',', array_fill(0, count($productIds), '?'));

            $query = $this->db->prepare("SELECT id, name, price, url_img FROM product WHERE id IN ($placeholders)");
            $query->execute($productIds);

            $products = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as &$product) {
                $productId = $product['id'];
                $product['qtty'] = $_SESSION['panier'][$productId];
            }

            return $products;
        } else {
            return [];
        }
    }

    // Ajoute un produit au panier
    public function addToCart($productId, $quantity)
    {
        if (isset($_SESSION['user_id'])) {
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
        } else {
            // Utilisateur non connecté, utilisez la session pour gérer le panier
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }

            if (isset($_SESSION['panier'][$productId])) {
                // Le produit existe déjà dans le panier, mettez à jour la quantité
                $_SESSION['panier'][$productId] += $quantity;
            } else {
                // Le produit n'existe pas encore dans le panier, ajoutez-le
                $_SESSION['panier'][$productId] = $quantity;
            }

            return true;
        }
    }

    // Supprime un produit du panier
    public function removeProductFromCart($productId)
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Supprimez le produit du panier
            $query = $this->db->prepare("DELETE FROM order_has_product
                                         WHERE user_order_id = (SELECT id FROM user_order WHERE user_id = :userId AND order_date IS NULL)
                                         AND product_id = :productId");

            $query->bindParam(':userId', $userId, PDO::PARAM_INT);
            $query->bindParam(':productId', $productId, PDO::PARAM_INT);

            return $query->execute();
        } else {
            // Utilisateur non connecté, utilisez la session pour gérer le panier
            if (isset($_SESSION['panier'][$productId])) {
                unset($_SESSION['panier'][$productId]);
                return true;
            }
        }

        return false;
    }

    // Vide complètement le panier
    public function clearCart()
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];

            // Supprimez tous les produits du panier
            $query = $this->db->prepare("DELETE FROM order_has_product
                                         WHERE user_order_id = (SELECT id FROM user_order WHERE user_id = :userId AND order_date IS NULL)");

            $query->bindParam(':userId', $userId, PDO::PARAM_INT);

            return $query->execute();
        } else {
            // Utilisateur non connecté, videz le panier de la session
            $_SESSION['panier'] = [];
            return true;
        }
    }
}
