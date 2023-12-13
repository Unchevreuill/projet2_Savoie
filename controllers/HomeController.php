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

    public function index()
    {
        // Fetch the latest products from the model
        $latestProducts = $this->model->getLatestProducts();
        
        // Render the home page with the list of products
        include 'views/pages/home.php';
    }

    public function viewProductDetails($productId)
    {
        // Get the details of a product from the model
        $productDetails = $this->model->getProductDetails($productId);

        // Render the product details page
        include 'views/pages/product_details.php';
    }

    public function addToCart($userId, $productId, $quantity)
    {
        // Add a product to the cart
        $success = $this->model->addToCart($userId, $productId, $quantity);
    
        // Redirect or display a message based on success
        if ($success) {
            header("Location: index.php?page=panier");
            exit;
        } else {
            echo "Failed to add the product to the cart.";
        }
    }
    public function getLatestProducts()
    {
        // Fetch the latest products from the model
        return $this->model->getLatestProducts();
    }
    
}
?>
