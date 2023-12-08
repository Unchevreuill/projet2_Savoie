<?php
namespace projet2_Savoie\Models;

use PDO;

class UserModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    // Get user details by email
    public function getUserByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // You can add more methods for user-related operations as needed
    // For example, methods to register a new user, update user details, etc.
}
