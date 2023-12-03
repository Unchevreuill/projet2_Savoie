<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Teccart Wear</title>
    <link rel="stylesheet" href="../css/inscription.css">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form action="../pages/inscription_logic.php" method="post">
            <!-- Informations de base -->
            <label for="email">Adresse e-mail :</label>
            <input type="email" name="email" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>

            <label for="confirm_password">Confirmer le mot de passe :</label>
            <input type="password" name="confirm_password" required>

            <label for="fname">Prénom :</label>
            <input type="text" name="fname" required>

            <label for="lname">Nom de famille :</label>
            <input type="text" name="lname" required>

            <!-- Informations d'adresse -->
            <label for="street_name">Nom de rue :</label>
            <input type="text" name="street_name" required>

            <label for="street_nb">Numéro de rue :</label>
            <input type="number" name="street_nb" required>

            <label for="city">Ville :</label>
            <input type="text" name="city" required>

            <label for="province">Province :</label>
            <input type="text" name="province" required>

            <label for="zipcode">Code postal :</label>
            <input type="text" name="zipcode" required>

            <button type="submit" name="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>
