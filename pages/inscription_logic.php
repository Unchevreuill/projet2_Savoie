<?php
session_start();

// Inclure le fichier de connexion à la base de données
include_once('./projet2_Savoie/db_connect.php');

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
        header('Location: inscription.php');
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
        header('Location: accueil.php');
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur lors de l'insertion, afficher l'erreur
        $_SESSION['inscription_error'] = "Erreur d'inscription : " . $e->getMessage();
        header('Location: inscription.php');
        exit();
    }
} else {
    // Rediriger vers la page d'accueil si aucune donnée de formulaire n'a été reçue
    header('Location: accueil.php');
    exit();
}
?>
