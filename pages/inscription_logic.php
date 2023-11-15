<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : '';
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $mot_de_passe = isset($_POST['mot_de_passe']) ? password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) : '';
    $confirmer_mot_de_passe = isset($_POST['confirmer_mot_de_passe']) ? password_hash($_POST['confirmer_mot_de_passe'], PASSWORD_DEFAULT) : '';

    // Valider les données (ajoutez vos propres règles de validation)

    if ($mot_de_passe !== $confirmer_mot_de_passe) {
        // Rediriger avec un message d'erreur
        $_SESSION['erreur_inscription'] = "Les mots de passe ne correspondent pas.";
        header('Location: inscription.php');
        exit();
    }
    // Exemple de redirection vers la page d'accueil après une inscription réussie
    $_SESSION['prenom_utilisateur'] = $prenom;
    header('Location: accueil.php');
    exit();
} else {
    // Rediriger si la page est accédée directement sans POST
    header('Location: inscription.php');
    exit();
}
?>
