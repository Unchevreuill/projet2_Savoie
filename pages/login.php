<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Teccart Wear</title>
    <link rel="stylesheet" href="chemin/vers/login.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
        </div>
    </header>

    <div class="container">
        <h2>Connexion</h2>
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
        </form>

        <p>Pas encore inscrit ? <a href="chemin/vers/inscription.php">Inscrivez-vous ici</a>.</p>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
