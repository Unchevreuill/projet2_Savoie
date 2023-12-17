<?php

namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\ProfilModel;

class ProfilController
{
    private $model;

    public function __construct(ProfilModel $model)
    {
        $this->model = $model;
    }

    public function getUserData($userId)
    {
        // Appelle la méthode getUserData du modèle
        return $this->model->getUserData($userId);
    }

    public function updateUser($userId, $userData)
    {
        // Appelle la méthode updateUser du modèle
        $result = $this->model->updateUser($userId, $userData);
        return $result;
    }

    public function getUserOrders($userId)
    {
        // Appelle la méthode getUserOrders du modèle
        return $this->model->getUserOrders($userId);
    }

    public function deleteUser($userId)
    {
        // Appelle la méthode deleteUser du modèle
        $result = $this->model->deleteUser($userId);
        return $result;
    }
}
?>
