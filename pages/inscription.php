<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Teccart Wear</title>
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
        </div>
    </header>

    <div class="container">
        <h2>Inscription</h2>
        <?php
        // Afficher les messages d'erreur ou de succès
        session_start();
        if (isset($_SESSION['inscription_error'])) {
            echo '<p class="error-message">' . $_SESSION['inscription_error'] . '</p>';
            unset($_SESSION['inscription_error']);
        }
        if (isset($_SESSION['inscription_success'])) {
            echo '<p class="success-message">' . $_SESSION['inscription_success'] . '</p>';
            unset($_SESSION['inscription_success']);
        }
        ?>

        <form method="post" action="inscription_logic.php">
            <label for="email">Email :</label>
            <input type="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>

            <label for="confirmPassword">Confirmer le mot de passe :</label>
            <input type="password" name="confirmPassword" required>

            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" required>

            <label for="fname">Prénom :</label>
            <input type="text" name="fname" required>

            <label for="lname">Nom :</label>
            <input type="text" name="lname" required>

            <input type="submit" name="inscription" value="S'inscrire">
        </form>

        <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>.</p>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
