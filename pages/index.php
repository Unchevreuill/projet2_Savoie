<?php
// Autoloading classes
spl_autoload_register(function ($class_name) {
    include 'controllers/' . $class_name . '.php';
    include 'models/' . $class_name . '.php';
    include 'views/' . $class_name . '.php';
});

// Database connection
$dsn = 'mysql:host=localhost;dbname=your_database;charset=utf8';
$user = 'your_username';
$password = 'your_password';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit();
}

// Create instances of the model, view, and controller
$model = new IndexModel($pdo);
$view = new IndexView();
$controller = new IndexController($model, $view);

// Call the index action
$controller->index();
?>
