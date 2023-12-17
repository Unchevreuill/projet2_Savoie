<?php

namespace projet2_Savoie\Models;

use PDO;
use PDOException;

class ProfilModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getUserData($userId)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des données de l'utilisateur: " . $e->getMessage());
            return null;
        }
    }

    public function updateUser($userId, $userData)
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET email = :email, fname = :fname, lname = :lname WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':email', $userData['email']);
            $stmt->bindParam(':fname', $userData['fname']);
            $stmt->bindParam(':lname', $userData['lname']);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erreur lors de la mise à jour de l'utilisateur: " . $e->getMessage());
            return false;
        }
    }

    public function getUserOrders($userId)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM orders WHERE user_id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des commandes de l'utilisateur: " . $e->getMessage());
            return [];
        }
    }

    public function deleteUser($userId)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erreur lors de la suppression de l'utilisateur: " . $e->getMessage());
            return false;
        }
    }
}
?>
