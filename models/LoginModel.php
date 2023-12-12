<?php
namespace projet2_Savoie\Models;

use PDO;

class LoginModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function checkLogin($email, $password)
    {
        // Vérifie si l'e-mail existe dans ma base de données
        $user = $this->getUserByEmail($email);

        if ($user) {
            // Vérifie le mot de passe
            if (password_verify($password, $user['pwd'])) {
                return $user; // Connexion réussie, retourne les informations de l'utilisateur
            }
        }

        return false; // Échec de la connexion
    }

    public function getUserByEmail($email)
    {
        $query = $this->db->prepare("
            SELECT u.*, a.*, r.name as role_name 
            FROM user u
            LEFT JOIN address a ON u.billing_address_id = a.id
            LEFT JOIN role r ON u.role_id = r.id
            WHERE u.email = :email
        ");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
