<?php

// Inclure l'autoloader
include_once 'autoload.php';

// Inclure la configuration de la base de données
include_once 'utils/DBConfig.php';

// Inclure les fichiers utilitaires
include_once 'utils/Crud.php';
include_once 'utils/routes.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION['user_id'])) {
    header('Location: /php2/projet2_Savoie/views/pages/login.php');
    exit();
}

// Inclure les fichiers nécessaires pour la page d'accueil
include_once 'views/pages/home.php';

// Créer des instances du modèle, de la vue et du contrôleur
$homeModel = new \projet2_Savoie\Models\HomeModel($pdo);
$homeView = new \projet2_Savoie\Views\HomeView();
$homeController = new \projet2_Savoie\Controllers\HomeController($HomeModel, $homeView);

// Appeler l'action index
$homeController->index();
