<?php

class CartController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function addToCart($productId) {
        // Get product details from the model based on $productId
        $product = $this->model->getProductById($productId);

        // Check if the product exists
        if ($product) {
            // Add the product to the cart in the model
            $this->model->addToCart($product);

            // Redirect to the index page with a success message
            header('Location: ../index.php?success=product_added_to_cart');
            exit();
        } else {
            // Redirect to the index page with an error message
            header('Location: ../index.php?error=product_not_found');
            exit();
        }
    }

    public function removeFromCart($productId) {
        // Remove the product from the cart in the model
        $this->model->removeFromCart($productId);

        // Refresh the cart page to reflect the changes
        header('Location: cart.php');
        exit();
    }

    public function viewCart() {
        // Get the cart data from the model
        $cartData = $this->model->getCart();

        // Render the cart view
        $this->view->render($cartData);
    }
}
