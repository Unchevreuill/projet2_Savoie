<?php
session_start();

// Initialiser les variables
$email = $password = $fname = $lname = '';

// Initialisation des variables d'erreur
$emailError = $passwordError = $fnameError = $lnameError = $registrationError = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Validation de l'e-mail
    if (empty($_POST['email'])) {
        $emailError = 'Veuillez entrer votre adresse e-mail.';
    } else {
        $email = $_POST['email'];
        // Vérifier si l'e-mail est bien formaté
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = 'Adresse e-mail invalide.';
        }
    }

    // Validation du mot de passe
    if (empty($_POST['password'])) {
        $passwordError = 'Veuillez entrer votre mot de passe.';
    } else {
        $password = $_POST['password'];
        // Vous pouvez ajouter d'autres validations pour le mot de passe ici
    }

    // Validation du prénom
    if (empty($_POST['fname'])) {
        $fnameError = 'Veuillez entrer votre prénom.';
    } else {
        $fname = $_POST['fname'];
    }

    // Validation du nom de famille
    if (empty($_POST['lname'])) {
        $lnameError = 'Veuillez entrer votre nom de famille.';
    } else {
        $lname = $_POST['lname'];
    }

    // Si toutes les validations sont réussies, procéder à l'inscription
    if (empty($emailError) && empty($passwordError) && empty($fnameError) && empty($lnameError)) {
        // Inclure le fichier de connexion à la base de données
        require_once '../db_connect.php';

        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Requête SQL pour insérer l'utilisateur dans la base de données
        $query = "INSERT INTO user (email, pwd, fname, lname, role_id) VALUES (:email, :pwd, :fname, :lname, :role_id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pwd', $hashedPassword);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindValue(':role_id', 3); // 3 est l'ID du rôle "client"
        
        // Exécuter la requête
        try {
            $stmt->execute();

            // Rediriger vers la page de connexion après l'inscription
            header('Location: ../pages/login.php');
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur d'inscription
            $registrationError = 'Erreur d\'inscription : ' . $e->getMessage();
        }
    }
}
?>
