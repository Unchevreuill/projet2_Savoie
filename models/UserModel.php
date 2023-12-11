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

    // Retrieve user information based on user ID
    public function getUserById($userId)
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE id = :userId");
        $query->bindParam(':userId', $userId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Retrieve user information based on email
    public function getUserByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>
