<?php

class IndexModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getFeaturedProducts() {
        // Query to retrieve featured products from the database
        $query = "SELECT * FROM product WHERE is_featured = 1 LIMIT 4";
        $stmt = $this->db->prepare($query);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database error
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
