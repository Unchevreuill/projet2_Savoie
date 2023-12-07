<?php
namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\ProductModel;
use projet2_Savoie\Views\HomeView;

class HomeController
{
    private $model;
    private $view;

    public function __construct(ProductModel $model, HomeView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function index()
    {
        //logique pour récupérer des produits du modèle
        $products = $this->model->getAllProducts();

        //rendu de la page d'accueil avec la liste des produits
        $this->view->renderHome($products);
    }

    public function viewProductDetails($productId)
    {
        //logique pour récupérer les détails d'un produit du modèle
        $productDetails = $this->model->getProductDetails($productId);

        // Exemple de rendu de la page des détails du produit
        $this->view->renderProductDetails($productDetails);
    }

    public function addToCart($productId)
    {
        // Exemple de logique pour ajouter un produit au panier
        $success = $this->model->addToCart($productId);

        // redirection ou d'affichage d'un message en fonction du succès
        if ($success) {
            header("Location: /cart");
            exit;
        } else {
            echo "Failed to add the product to the cart.";
        }
    }

    
}
