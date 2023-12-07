<?php
session_start();

// Inclure le fichier de connexion à la base de données
require_once '../db_connect.php';

// Initialisation des variables d'erreur
$emailError = $passwordError = $fnameError = $lnameError = $registrationError = $usernameError = $confirmPasswordError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    // Validation de l'email
    if (empty($email)) {
        $emailError = 'Veuillez entrer votre adresse e-mail.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Veuillez entrer une adresse e-mail valide.';
    }

    // Validation du mot de passe
    if (empty($password)) {
        $passwordError = 'Veuillez entrer votre mot de passe.';
    } elseif (strlen($password) < 6) {
        $passwordError = 'Le mot de passe doit comporter au moins 6 caractères.';
    }

    // Validation de la confirmation du mot de passe
    if (empty($confirmPassword) || $confirmPassword !== $password) {
        $confirmPasswordError = 'Les mots de passe ne correspondent pas.';
    }

    // Validation du prénom
    if (empty($fname)) {
        $fnameError = 'Veuillez entrer votre prénom.';
    }

    // Validation du nom de famille
    if (empty($lname)) {
        $lnameError = 'Veuillez entrer votre nom de famille.';
    }

    // Si aucune erreur de validation
    if (empty($emailError) && empty($passwordError) && empty($fnameError) && empty($lnameError)) {
        // Commencer une transaction
        $pdo->beginTransaction();

        try {
            // Hasher le mot de passe
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insérer l'utilisateur dans la table "user"
            $queryUser = "INSERT INTO user (email, pwd, fname, lname, role_id) VALUES (:email, :password, :fname, :lname, 3)";
            $stmtUser = $pdo->prepare($queryUser);
            $stmtUser->bindParam(':email', $email);
            $stmtUser->bindParam(':password', $hashedPassword);
            $stmtUser->bindParam(':fname', $fname);
            $stmtUser->bindParam(':lname', $lname);
            $stmtUser->execute();

            // Récupérer l'ID de l'utilisateur nouvellement créé
            $userId = $pdo->lastInsertId();

            // Insérer l'adresse dans la table "address"
            $queryAddress = "INSERT INTO address (user_id) VALUES (:userId)";
            $stmtAddress = $pdo->prepare($queryAddress);
            $stmtAddress->bindParam(':userId', $userId);
            $stmtAddress->execute();

            // Valider la transaction
            $pdo->commit();

            // L'inscription a réussi, rediriger vers l'inscription avec un message de confirmation
            header('Location: ../pages/inscription.php?success=1');
            exit();
        } catch (PDOException $e) {
            // Erreur lors de l'insertion dans la base de données, annuler la transaction
            $pdo->rollBack();
            $registrationError = 'Erreur d\'inscription : ' . $e->getMessage();
        }
    }
}



?>

