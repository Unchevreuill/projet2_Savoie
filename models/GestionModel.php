<?php

namespace projet2_Savoie\Models;

use PDO;
use PDOException;

class GestionModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function addProduct($productData)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO products (name, price, quantity, description) VALUES (:name, :price, :quantity, :description)");
            $stmt->bindParam(':name', $productData['name']);
            $stmt->bindParam(':price', $productData['price']);
            $stmt->bindParam(':quantity', $productData['quantity']);
            $stmt->bindParam(':description', $productData['description']);
            $stmt->execute();

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Gérer l'erreur
            error_log("Erreur lors de l'ajout du produit: " . $e->getMessage());
            return false;
        }
    }

    public function getAllOrders()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM orders"); // Assurez-vous que la table et les colonnes correspondent à votre schéma de base de données
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer l'erreur
            error_log("Erreur lors de la récupération des commandes: " . $e->getMessage());
            return [];
        }
    }

    // Ajoutez ici d'autres méthodes selon vos besoins
}
?>
