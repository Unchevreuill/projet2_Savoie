<?php

class IndexModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getFeaturedProducts() {
        // Example: Fetch featured products from the database
        $query = "SELECT * FROM products WHERE featured = 1";
        $stmt = $this->pdo->prepare($query);
        
        try {
            $stmt->execute();
            $featuredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $featuredProducts;
        } catch (PDOException $e) {
            // Handle the exception or log the error
            return [];
        }
    }

    // You can add more methods based on your needs
}

?>
