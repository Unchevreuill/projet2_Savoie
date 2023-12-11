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
        // Vérifiez si l'e-mail existe dans la base de données
        $user = $this->getUserByEmail($email);

        if ($user) {
            // Vérifiez le mot de passe
            if (password_verify($password, $user['password'])) {
                return true; // Connexion réussie
            }
        }

        return false; // Échec de la connexion
    }

    public function getUserByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
