<?php
// Inclusion du fichier pour l'autoload des classes
include_once 'autoload.php';

// Inclusion du fichier de configuration de la base de données
include_once 'utils/DBConfig.php';

// Démarrage de la session
session_start();

// Création d'une instance PDO pour la connexion à la base de données
$dbConfig = DbConfig::getInstance();
$pdo = $dbConfig->getConnection();

// Détermination de la page à charger
$page = $_GET['page'] ?? 'home';

// Chargement conditionnel des modèles et contrôleurs
switch ($page) {
    case 'home':
        include_once('models/HomeModel.php');
        include_once('controllers/HomeController.php');
        $homeModel = new \projet2_Savoie\Models\HomeModel($pdo);
        $homeController = new \projet2_Savoie\Controllers\HomeController($homeModel);
        break;
    case 'inscription':
        include_once('models/InscriptionModel.php');
        include_once('controllers/InscriptionController.php');
        $inscriptionModel = new \projet2_Savoie\Models\InscriptionModel($pdo);
        $inscriptionController = new \projet2_Savoie\Controllers\InscriptionController($inscriptionModel);
        break;

}

// Gestion de la soumission des formulaires et d'autres actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement de la soumission du formulaire d'inscription
    if (isset($_POST['action']) && $_POST['action'] == 'register' && $page == 'inscription') {
        $userData = [
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'fname' => $_POST['fname'] ?? '',
            'lname' => $_POST['lname'] ?? '',
            'username' => $_POST['username'] ?? '', 
        ];
        $addressData = [
            'street_name' => $_POST['street_name'] ?? '',
            'street_nb' => $_POST['street_nb'] ?? '',
            'city' => $_POST['city'] ?? '',
            'province' => $_POST['province'] ?? '',
            'zipcode' => $_POST['zipcode'] ?? '',
            'country' => $_POST['country'] ?? ''
        ];
        $inscriptionController->createUser($userData, $addressData);
         header('Location: index.php?page=home');
         exit();
    }
}

// Routage de page
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
        session_destroy(); // Gestion de la déconnexion
        header('Location: index.php?page=home'); // Redirection vers la page d'accueil
        exit();
   
}


