<?php
// Inclure les fichiers nécessaires pour la connexion à la base de données, modèles, contrôleurs, etc.
include_once('utils/DBConfig.php');
include_once('models/ProfilModel.php');
include_once('controllers/ProfilController.php');

session_start();

if (!isset($_SESSION['user'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}

$dbConfig = DbConfig::getInstance();
$pdo = $dbConfig->getConnection();
$profilModel = new \projet2_Savoie\Models\ProfilModel($pdo);
$profilController = new \projet2_Savoie\Controllers\ProfilController($profilModel);

$userId = $_SESSION['user']['id'];

// Traiter la mise à jour des informations de l'utilisateur
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Collecter les données du formulaire
    $userData = [
        'email' => $_POST['email'],
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname']
        // Ajouter d'autres champs si nécessaire
    ];
    $profilController->updateUser($userId, $userData);
}

// Traiter la demande de suppression du compte
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
    $profilController->deleteUser($userId);
    // Déconnecter l'utilisateur et rediriger
    session_destroy();
    header('Location: login.php');
    exit();
}

$userData = $profilController->getUserData($userId);
$userOrders = $profilController->getUserOrders($userId);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil de l'utilisateur</title>
    <link rel="stylesheet" href="profil.css">
</head>
<body>
    <div class="profil-container">
        <h1>Profil de l'utilisateur</h1>
        
        <!-- Formulaire de mise à jour des informations -->
        <form method="post">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>

            <label>Prénom:</label>
            <input type="text" name="fname" value="<?php echo htmlspecialchars($userData['fname']); ?>" required>

            <label>Nom:</label>
            <input type="text" name="lname" value="<?php echo htmlspecialchars($userData['lname']); ?>" required>       
            <button type="submit" name="update">Mettre à jour</button>
        </form>

        <!-- Option de suppression du compte -->
        <form method="post">
            <button type="submit" name="delete">Supprimer mon compte</button>
        </form>

        <h2>Commandes de l'utilisateur</h2>
        <div class="order-history">
            <?php foreach ($userOrders as $order) : ?>
                <div class="order-item">
                    <!-- Affiche les détails de la commande-->
                    <p>Commande ID: <?php echo $order['id']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
