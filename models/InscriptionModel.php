<?php
namespace projet2_Savoie\Models;

use PDO;
use PDOException;

class InscriptionModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createUser($userData, $addressData)
    {
        // Commencer une transaction
        $this->db->beginTransaction();

        try {
            // Insérer l'adresse
            $addressId = $this->createAddress($addressData);

            // Définir l'ID du rôle 'client'
            $roleId = $this->getRoleId('client');

            // Préparer la requête pour insérer l'utilisateur
            $stmt = $this->db->prepare("INSERT INTO user (email, pwd, fname, lname, billing_address_id, shipping_address_id, role_id) VALUES (:email, :pwd, :fname, :lname, :billing_address_id, :shipping_address_id, :role_id)");
            
            // Hasher le mot de passe
            $hashedPassword = password_hash($userData['password'], PASSWORD_DEFAULT);

            // Lier les paramètres
            $stmt->bindParam(':email', $userData['email']);
            $stmt->bindParam(':pwd', $hashedPassword);
            $stmt->bindParam(':fname', $userData['fname']);
            $stmt->bindParam(':lname', $userData['lname']);
            $stmt->bindParam(':billing_address_id', $addressId);
            $stmt->bindParam(':shipping_address_id', $addressId); // Supposons que l'adresse de livraison est la même que l'adresse de facturation
            $stmt->bindParam(':role_id', $roleId);

            // Exécuter la requête
            $stmt->execute();

            // Valider la transaction
            $this->db->commit();

            return true;
        } catch (PDOException $e) {
            // Annuler la transaction en cas d'erreur
            $this->db->rollBack();
            throw $e;
        }
    }

    private function createAddress($addressData)
    {
        $stmt = $this->db->prepare("INSERT INTO address (street_name, street_nb, city, province, zipcode, country) VALUES (:street_name, :street_nb, :city, :province, :zipcode, :country)");

        $stmt->bindParam(':street_name', $addressData['street_name']);
        $stmt->bindParam(':street_nb', $addressData['street_nb']);
        $stmt->bindParam(':city', $addressData['city']);
        $stmt->bindParam(':province', $addressData['province']);
        $stmt->bindParam(':zipcode', $addressData['zipcode']);
        $stmt->bindParam(':country', $addressData['country']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    private function getRoleId($roleName)
    {
        $stmt = $this->db->prepare("SELECT id FROM role WHERE name = :name");
        $stmt->bindParam(':name', $roleName);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }
}
?>
