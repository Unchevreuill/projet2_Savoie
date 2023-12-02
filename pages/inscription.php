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
            <h1>Inscription</h1>
        </div>
    </header>
    
    <div class="container">
        <!-- Assurez-vous que le chemin vers votre fichier inscription_logic.php est correct -->
        <?php include_once '../pages/inscription_logic.php'; ?>

        <form method="post" action="../pages/inscription_logic.php">
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>
            <span class="error"><?php echo $emailError; ?></span>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <span class="error"><?php echo $passwordError; ?></span>

            <label for="fname">Prénom :</label>
            <input type="text" id="fname" name="fname" required>
            <span class="error"><?php echo $fnameError; ?></span>

            <label for="lname">Nom de famille :</label>
            <input type="text" id="lname" name="lname" required>
            <span class="error"><?php echo $lnameError; ?></span>

            <!-- Ajoutez d'autres champs ici en fonction de vos besoins -->

            <input type="submit" name="submit" value="S'inscrire">
        </form>

        <span class="error"><?php echo $registrationError; ?></span>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
