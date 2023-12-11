<?php

namespace projet2_Savoie\Models;

use PDO;

class HomeModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    //Récupérer tous les produits
    public function getAllProducts()
    {
        $query = $this->db->query("SELECT * FROM product");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //Récupérer les produits vedettes
    public function getFeaturedProducts()
    {
        $query = $this->db->query("SELECT * FROM product WHERE featured = 1");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}