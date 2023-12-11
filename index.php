<?php

// Include the autoloader
include_once 'autoload.php';

// Include the configuration of the database
include_once 'utils/DBConfig.php';

// Include the utility files
include_once 'utils/Crud.php';
include_once 'utils/routes.php';

// Start the session
session_start();

// Check if the user is not logged in, redirect to the home page
if (!isset($_SESSION['user_id'])) {
    header('Location: /php2/projet2_Savoie/views/pages/home.php');
    exit();
}

// Include the necessary files for the home page
include_once 'views/pages/home.php';

// Create instances of the model, view, and controller for the home page
$homeModel = new \projet2_Savoie\Models\HomeModel($pdo);
$homeView = new \projet2_Savoie\Views\HomeView();
$homeController = new \projet2_Savoie\Controllers\HomeController($HomeModel, $homeView);

// Call the index action for the home page
$homeController->index();

// Include the necessary files for the login page
include_once 'views/pages/login.php';
include_once 'controllers/LoginController.php';
include_once 'models/LoginModel.php';
include_once 'views/LoginView.php';

// Create instances of the model, view, and controller for the login page
$loginModel = new \projet2_Savoie\Models\LoginModel($pdo);
$loginView = new \projet2_Savoie\Views\LoginView();
$loginController = new \projet2_Savoie\Controllers\LoginController($LoginModel, $loginView);

// Call the login action for the login page
$loginController->processLogin();

?>
