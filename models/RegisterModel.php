<?php

class RegisterModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function registerUser($name, $email, $password) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query to insert a new user into the database
        $query = "INSERT INTO user (name, email, pwd) VALUES (:name, :email, :password)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle database error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
