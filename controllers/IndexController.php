<?php

class IndexController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function index() {
        // Get product data from the model
        $products = $this->model->getAllProducts();

        // Render the index view with the product data
        $this->view->render($products);
    }
}
