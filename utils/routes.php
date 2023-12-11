<?php

$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

// Chargez les classes nécessaires
require_once 'controllers/HomeController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CartController.php';

// Définir des routes
$routes = [
    '/home' => ['HomeController', 'render'],
    '/products' => ['ProductController', 'render'],
    '/cart' => ['CartController', 'render'],
];

// Vérifier si la route existe
if (array_key_exists($url, $routes)) {
    list($controllerName, $methodName) = $routes[$url];

    // Instancier le contrôleur et appeler la méthode
    $controller = new $controllerName();
    $controller->$methodName();
} else {
    // Gérer les routes non définies
    echo 'Page non trouvée';
}
