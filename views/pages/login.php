<?php
session_start();
// Initialiser les variables d'erreur
$emailError = $passwordError = $loginError = '';

// Inclure le fichier de configuration de la base de données
include_once('../../utils/DBConfig.php');

// Inclure le modèle, la vue et le contrôleur de connexion
include_once('../../models/LoginModel.php');
include_once('../../views/LoginView.php');
include_once('../../controllers/LoginController.php');
include_once('../../models/UserModel.php');

// Créer une instance de la classe DbConfig
$dbConfig = new DbConfig();
$pdo = $dbConfig->getConnection();

// Créer une instance du modèle, de la vue et du contrôleur de connexion
$userModel = new \projet2_Savoie\Models\UserModel($pdo);
$loginModel = new \projet2_Savoie\Models\LoginModel($dbConfig->getConnection());
$loginView = new \projet2_Savoie\Views\LoginView();
$loginController = new \projet2_Savoie\Controllers\LoginController($userModel, $loginView);


// Traiter la soumission du formulaire de connexion
$loginController->processLogin();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Connexion</title>
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
        </div>
    </header>

    <div class="container">
        <h2>Connexion</h2>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Adresse E-mail:</label>
                <input type="email" id="email" name="email" class="input-field" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <span class="error"><?php echo isset($emailError) ? $emailError : ''; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" class="input-field">
                <span class="error"><?php echo isset($passwordError) ? $passwordError : ''; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" name="connexion" value="Se connecter" class="login-button">
            </div>

            <span class="error"><?php echo isset($loginError) ? $loginError : ''; ?></span>
        </form>

        <p>Pas encore inscrit ? <a href="../pages/inscription.php">Inscrivez-vous ici</a>.</p>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
