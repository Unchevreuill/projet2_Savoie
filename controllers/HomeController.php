<?php
namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\HomeModel;

class HomeController
{
    private $model;

    public function __construct(HomeModel $model)
    {
        $this->model = $model;
    }

    public function getLatestProducts()
    {
        // Fetch the latest products from the model
        return $this->model->getLatestProducts();
    }

    public function viewProductDetails($productId)
    {
        // Get the details of a product from the model
        return $this->model->getProductDetails($productId);
    }

    public function addToCart($userId, $productId, $quantity)
    {
        //add a product to the cart
        $success = $this->model->addToCart($userId, $productId, $quantity);
    
        // Redirect or display a message based on success
        if ($success) {
            header("Location: /panier.php");
            exit;
        } else {
            echo "Failed to add the product to the cart.";
        }
    }

}
