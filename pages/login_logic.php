<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
    // Inclure le fichier de connexion à la base de données
    require_once './projet2_Savoie/db_connect.php';

    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête SQL pour récupérer l'utilisateur avec l'email donné
    $query = "SELECT * FROM user WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['pwd'])) {
        // Enregistrez les informations de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role_id'];

        // Rediriger vers la page d'accueil
        header('Location: ../pages/accueil.php');
        exit();
    } else {
        // Utilisateur non trouvé ou mot de passe incorrect
        $_SESSION['login_error'] = 'Email ou mot de passe incorrect.';
        header('Location: ../pages/login.php');
        exit();
    }
} else {
    // Rediriger vers la page de connexion si aucune donnée de formulaire n'a été reçue
    header('Location: ../pages/login.php');
    exit();
}
?>