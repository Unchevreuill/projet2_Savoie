<?php

namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\GestionModel;

class GestionController
{
    private $model;

    public function __construct(GestionModel $model)
    {
        $this->model = $model;
    }

    public function addProduct($productData)
    {
        $result = $this->model->addProduct($productData);

        return $result;
    }

    public function viewOrders()
    {
        // Appeler la méthode getAllOrders du modèle
        $orders = $this->model->getAllOrders();
        return $orders;
    }

   
}
?>
