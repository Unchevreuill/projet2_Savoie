<?php
namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\ProductModel; 

class CartController
{
    private $productModel;

    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
    }

    public function render()
    {
        // Récupérez le contenu du panier depuis la session
        $cartItems = isset($_SESSION['panier']) ? $_SESSION['panier'] : [];

        // Récupérez les détails des produits dans le panier depuis la base de données
        $cartProducts = $this->productModel->getProductsByIds($cartItems);


        // Incluez la vue correspondante avec les données nécessaires
        include_once('../../views/pages/panier.php');
    }
}
