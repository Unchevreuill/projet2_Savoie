<?php

$url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';

// Chargez les classes nécessaires
require_once 'controllers/PageController.php';

// Définir des routes
$routes = [
    '/home' => ['PageController', 'homePage'],
    '/products' => ['PageController', 'products'],
    '/cart' => ['PageController', 'cart'],
];

// Vérifier si la route existe
if (array_key_exists($url, $routes)) {
    list($controllerName, $methodName) = $routes[$url];

    // Instancier le contrôleur et appeler la méthode
    $controller = new $controllerName();
    $controller->$methodName();
} else {
    // Gérer d'autres cas ou rediriger vers une page par défaut
    // ...
}
