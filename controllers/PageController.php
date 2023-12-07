<?php

namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\ProductModel; // Assurez-vous que le chemin est correct
use projet2_Savoie\Models\CartModel; // Assurez-vous que le chemin est correct
use projet2_Savoie\Views\PageView;

class PageController
{
    private $view;
    private $db;

    public function __construct($db)
    {
        $this->view = new PageView();
        $this->db = $db;
    }

    public function homePage()
    {
        // Logique spécifique pour la page d'accueil
        $this->view->render('home');
    }

    public function products()
    {
        // Logique spécifique pour la page de produits
        $productModel = new ProductModel($this->db);
        $products = $productModel->getAllProducts();

        // Passez les données à la vue
        $this->view->render('products', ['products' => $products]);
    }

    public function cart()
    {
        // Logique spécifique pour la page de panier
        $cartModel = new CartModel($this->db);
        $cartContents = $cartModel->getCartContents();

        // Passez les données à la vue
        $this->view->render('cart', ['cartContents' => $cartContents]);
    }
}
