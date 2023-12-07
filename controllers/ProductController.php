<?php

namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\Product;
use projet2_Savoie\Views\ProductView;

class ProductController
{
    private $model;
    private $view;

    public function __construct(Product $model, ProductView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function viewAllProducts()
    {
        // Fetch all products from the model
        $products = $this->model->getAllProducts();

        // Render the product view with the product data
        $this->view->renderAllProducts($products);
    }

    public function viewProductDetails($productId)
    {
        // Fetch product details by ID from the model
        $productDetails = $this->model->getProductDetails($productId);

        // Render the product details view with the product details
        $this->view->renderProductDetails($productDetails);
    }

    public function addToCart($productId)
    {
        // Add the product to the cart using the model
        $success = $this->model->addToCart($productId);

        // Optionally, you can redirect or show a success message
        if ($success) {
            header("Location: /cart");
            exit;
        } else {
            echo "Failed to add the product to the cart.";
        }
    }
}
