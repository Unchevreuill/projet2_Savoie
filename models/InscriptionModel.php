<?php

namespace projet2_Savoie\models;

use PDO;
use PDOException;

class InscriptionModel
{

    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createUser($userData, $addressData) {
        // Commencer une transaction
        $this->db->beginTransaction();
    
        try {
            // Insére l'adresse et obtenir l'ID
            $addressId = $this->createAddress($addressData);
    
            // Génére un token
            $token = bin2hex(random_bytes(16)); // Exemple de génération d'un token aléatoire
    
            // Définir l'ID du rôle 'client' à 3
            $roleId = 3;
    
            // Préparer la requête pour insérer l'utilisateur
            $stmt = $this->db->prepare("INSERT INTO user (email, token, username, fname, lname, pwd, billing_address_id, shipping_address_id, role_id) VALUES (:email, :token, :username, :fname, :lname, :pwd, :billing_address_id, :shipping_address_id, :role_id)");
            
            // Hasher le mot de passe
            $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);
    
            // Lier les paramètres et exécuter la requête
            $stmt->bindParam(':email', $userData['email']);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':username', $userData['username']);
            $stmt->bindParam(':fname', $userData['fname']);
            $stmt->bindParam(':lname', $userData['lname']);
            $stmt->bindParam(':pwd', $hashedPassword);
            $stmt->bindParam(':billing_address_id', $addressId);
            $stmt->bindParam(':shipping_address_id', $addressId);
            $stmt->bindParam(':role_id', $roleId);
    
            $stmt->execute();
    
            // Récupérer l'ID de l'utilisateur nouvellement créé
            $userId = $this->db->lastInsertId();
    
            // Valider la transaction
            $this->db->commit();
    
            // Retourner l'ID de l'utilisateur
            return $userId;
        } catch (PDOException $e) {
            // Annuler la transaction en cas d'erreur
            $this->db->rollBack();
            error_log("Erreur lors de la création de l'utilisateur: " . $e->getMessage());
            throw $e;
        }
    }
    
    
    

    private function createAddress($addressData){
        try {
        $stmt = $this->db->prepare("INSERT INTO address (street_name, street_nb, city, province, zipcode, country) VALUES (:street_name, :street_nb, :city, :province, :zipcode, :country)");

        $stmt->bindParam(':street_name', $addressData['street_name']);
        $stmt->bindParam(':street_nb', $addressData['street_nb']);
        $stmt->bindParam(':city', $addressData['city']);
        $stmt->bindParam(':province', $addressData['province']);
        $stmt->bindParam(':zipcode', $addressData['zipcode']);
        $stmt->bindParam(':country', $addressData['country']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }catch (PDOException $e) {
        // Gérer l'erreur ou la logger
        error_log("Erreur lors de la création de l'adresse: " . $e->getMessage());
        throw $e;
    } }
}
?>
