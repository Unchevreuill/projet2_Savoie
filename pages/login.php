<?php
session_start();


include_once('../db_connect.php');
include_once('../pages/login_logic.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Teccart Wear - Connexion</title>
    <link rel="stylesheet" href="../css/login.css">
=======
    <title>Connexion - Teccart Wear</title>
    <link rel="stylesheet" href="chemin/vers/login.css">
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
        </div>
    </header>

    <div class="container">
        <h2>Connexion</h2>
<<<<<<< HEAD
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Adresse E-mail:</label>
                <input type="email" id="email" name="email" class="input-field" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <span class="error"><?php echo $emailError; ?></span>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" class="input-field">
                <span class="error"><?php echo $passwordError; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Se connecter" class="login-button">
            </div>

            <span class="error"><?php echo $loginError; ?></span>
=======
        <?php
        // Afficher les messages d'erreur ou de succès
        session_start();
        if (isset($_SESSION['login_error'])) {
            echo '<p class="error-message">' . $_SESSION['login_error'] . '</p>';
            unset($_SESSION['login_error']);
        }
        ?>

        <form method="post" action="chemin/vers/login_logic.php">
            <label for="email">Email :</label>
            <input type="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>

            <input type="submit" name="connexion" value="Se connecter">
>>>>>>> a3448273eb94aff6d3b03413b1a0acff662e0f7f
        </form>

        <p>Pas encore inscrit ? <a href="chemin/vers/inscription.php">Inscrivez-vous ici</a>.</p>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
