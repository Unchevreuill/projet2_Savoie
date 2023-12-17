<?php
// Initialiser les variables d'erreur et les variables de champ
$errors = [];
$userData = [
    'email' => '',
    'password' => '',
    'fname' => '',
    'lname' => '',
    // 'username' => '', // Décommentez si vous utilisez 'username'
];
$addressData = [
    'street_name' => '',
    'street_nb' => '',
    'city' => '',
    'province' => '',
    'zipcode' => '',
    'country' => ''
];

// Traiter la soumission du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecter les données du formulaire
    $userData['email'] = $_POST['email'];
    $userData['password'] = $_POST['password'];
    $userData['fname'] = $_POST['fname'];
    $userData['lname'] = $_POST['lname'];
    $userData['username'] = $_POST['username'];
    
    $addressData['street_name'] = $_POST['street_name'];
    $addressData['street_nb'] = $_POST['street_nb'];
    $addressData['city'] = $_POST['city'];
    $addressData['province'] = $_POST['province'];
    $addressData['zipcode'] = $_POST['zipcode'];
    $addressData['country'] = $_POST['country'];

    // Affichage des données du formulaire pour le débogage
    echo '<pre>';
    var_dump($userData);
    var_dump($addressData);
    echo '</pre>';
    // die(); 

    if (empty($errors)) {
        try {
            // Tentative de création de l'utilisateur
            // Assurez-vous que $inscriptionModel est correctement initialisé et passé à cette page
            if ($inscriptionModel->createUser($userData, $addressData)) {
                echo '<p>Inscription réussie</p>';

                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['user'] = $userData;

                // Redirection vers home.php (Commentée pour le débogage)
                // header('Location: home.php');
                // exit();
            } else {
                echo '<p>Échec de l\'inscription</p>';
            }
        } catch (Exception $e) {
            $errors[] = "Erreur lors de l'inscription: " . $e->getMessage();
        }
    }
    }

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Teccart Wear</title>
    <link rel="stylesheet" href="css/inscription.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Inscription - Teccart Wear</h1>
        </div>
    </header>
    <nav class="dark-nav">
    <ul>
        <li><a href="index.php?page=home">Accueil</a></li>
        <li><a href="index.php?page=inscription">Inscription</a></li>
        <li><a href="index.php?page=login">Connexion</a></li>
        <li><a href="index.php?page=panier">Panier</a></li>
        <?php if (isset($_SESSION['user'])): ?>
        <li><a href="index.php?page=deconnexion">Déconnexion</a></li>
        <?php endif; ?>
    </ul>
</nav>
    <div class="container">
        <h2>Inscrivez-vous</h2>

        <!-- Afficher les erreurs -->
        <?php foreach ($errors as $error) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endforeach; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Champs pour les informations de l'utilisateur -->
            <div class="form-group">
                <label for="email">Adresse E-mail:</label>
                <input type="email" id="email" name="email" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="fname">Prénom:</label>
                <input type="text" id="fname" name="fname" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="lname">Nom de famille:</label>
                <input type="text" id="lname" name="lname" class="input-field" required>
            </div>

            <!-- Champs pour l'adresse -->
            <div class="form-group">
                <label for="street_name">Nom de rue:</label>
                <input type="text" id="street_name" name="street_name" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="street_nb">Numéro de rue:</label>
                <input type="text" id="street_nb" name="street_nb" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="city">Ville:</label>
                <input type="text" id="city" name="city" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="province">Province:</label>
                <input type="text" id="province" name="province" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="zipcode">Code Postal:</label>
                <input type="text" id="zipcode" name="zipcode" class="input-field" required>
            </div>

            <div class="form-group">
                <label for="country">Pays:</label>
                <input type="text" id="country" name="country" class="input-field" required>
            </div>

            <div class="form-group">
                <input type="submit" name="inscription" value="S'inscrire" class="inscription-button">
            </div>
        </form>
        

        <p>Déjà inscrit ? <a href="login.php">Connectez-vous ici</a>.</p>
    </div>

    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
