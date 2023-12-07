<?php
// Include autoloader
include_once 'autoload.php';

// Include database connection
include_once './utils/DBConfig.php';

// Include utility files
include_once 'utils/Crud.php';
include_once 'utils/routes.php';

// Start session
session_start();

// Check if the user is not logged in, redirect to the home page
if (!isset($_SESSION['user_id'])) {
    header('Location: /php2/projet2_Savoie/views/pages/home.php');
    exit();
}

// Include necessary files for the home page
include_once 'views/pages/home.php';

// Create instances of the model, view, and controller (assuming you have a Home model, view, and controller)
$homeModel = new \projet2_Savoie\Models\HomeModel($pdo);
$homeView = new \projet2_Savoie\Views\HomeView();
$homeController = new \projet2_Savoie\Controllers\HomeController($HomeModel, $homeView);

// Call the index action
$homeController->index();
