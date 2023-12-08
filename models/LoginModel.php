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

    // Méthode pour vérifier les informations de connexion
    public function checkLogin($email, $password)
    {
        // TODO: Implement your login logic here
        // For example, query the database to check if the email and password match
        // Return true if login is successful, false otherwise
    }
}
