<?php
session_start();

// Inclure le fichier de connexion à la base de données
<<<<<<< HEAD
include_once('../db_connect.php');
=======
include_once('./projet2_Savoie/db_connect.php');
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    // Ajouter des vérifications supplémentaires si nécessaire

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirmPassword) {
        $_SESSION['inscription_error'] = "Les mots de passe ne correspondent pas.";
<<<<<<< HEAD
        header('Location: ../pages/inscription.php');
=======
        header('Location: inscription.php');
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f
        exit();
    }

    // Hasher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans la base de données
    try {
        $stmt = $pdo->prepare("INSERT INTO user (email, pwd, username, fname, lname, role_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$email, $hashedPassword, $username, $fname, $lname, 3]); // 3 est l'ID du rôle "client"
        
        // Rediriger vers la page d'accueil après l'inscription réussie
        $_SESSION['inscription_success'] = "Inscription réussie. Connectez-vous maintenant.";
<<<<<<< HEAD
        header('Location: ../index.php');
=======
        header('Location: accueil.php');
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur lors de l'insertion, afficher l'erreur
        $_SESSION['inscription_error'] = "Erreur d'inscription : " . $e->getMessage();
<<<<<<< HEAD
        header('Location: ../pages/inscription.php');
=======
        header('Location: inscription.php');
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f
        exit();
    }
} else {
    // Rediriger vers la page d'accueil si aucune donnée de formulaire n'a été reçue
<<<<<<< HEAD
    header('Location: ../index.php');
=======
    header('Location: accueil.php');
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f
    exit();
}
?>
