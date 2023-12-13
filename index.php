<?php
// Include the file for class autoloading
include_once 'autoload.php';

// Include the database configuration file
include_once 'utils/DBConfig.php';

// Start the session
session_start();

// Create a PDO instance for database connection
$dbConfig = DbConfig::getInstance();
$pdo = $dbConfig->getConnection();

// Determine which page to load based on the 'page' parameter
$page = $_GET['page'] ?? 'home'; // Default to 'home' if no parameter is set

// Include necessary files for the requested page
include_once('models/HomeModel.php');
include_once('controllers/HomeController.php');
$homeModel = new \projet2_Savoie\Models\HomeModel($pdo);
$homeController = new \projet2_Savoie\Controllers\HomeController($homeModel);

// Handle add-to-cart form submission and other actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'add_to_cart' && isset($_POST['product_id'])) {
        $userId = $_SESSION['user_id'] ?? null; 
        if ($userId) {
            $productId = $_POST['product_id'];
            $quantity = 1; // Adjust based on your form or business logic
            $homeController->addToCart($userId, $productId, $quantity);
        }
    }
    // Additional POST actions can be handled here
}

// Page routing
switch ($page) {
    case 'home':
        include 'views/pages/home.php';
        break;
    case 'inscription':
        include 'views/pages/inscription.php';
        break;
    case 'login':
        include 'views/pages/login.php';
        break;
    case 'panier':
        include 'views/pages/panier.php';
        break;
    case 'deconnexion':
        // Handle deconnexion logic and redirect
        include 'views/pages/deconnexion.php';
        header('Location: index.php?page=home');
        exit();
    
    
}

?>
