<?php
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
    $streetName = $_POST['street_name'];
    $streetNb = $_POST['street_nb'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];

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
        $passwordError = 'Les mots de passe ne correspondent pas.';
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
        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insérer l'utilisateur dans la base de données
        $query = "INSERT INTO user (email, pwd, fname, lname, role_id, shipping_address_id) VALUES (:email, :password, :fname, :lname, 3, NULL)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);

        try {
            $stmt->execute();
            // L'inscription a réussi, rediriger vers l'index
            header('Location: ../index.php');
            exit();
        } catch (PDOException $e) {
            // Erreur lors de l'insertion dans la base de données
            $registrationError = 'Erreur d\'inscription : ' . $e->getMessage();
        }
    }
}

// Le reste de votre logique...
?>
