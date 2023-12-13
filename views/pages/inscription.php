<?php
// Initialiser les variables d'erreur et les variables de champ
$errors = [];
$userData = [
    'email' => '',
    'password' => '',
    'fname' => '',
    'lname' => ''
];
$addressData = [
    'street_name' => '',
    'street_nb' => '',
    'city' => '',
    'province' => '',
    'zipcode' => '',
    'country' => ''
];

// Inclure le fichier de configuration de la base de données
include_once('utils/DBConfig.php');

// Inclure le modèle d'inscription
include_once('models/InscriptionModel.php');

// Créer une instance de la classe DbConfig
$dbConfig = new DbConfig();
$pdo = $dbConfig->getConnection();

// Créer une instance du modèle d'inscription
$inscriptionModel = new \projet2_Savoie\Models\InscriptionModel($pdo);

// Traiter la soumission du formulaire d'inscription
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecter les données du formulaire
    $userData['email'] = $_POST['email'];
    $userData['password'] = $_POST['password'];
    $userData['fname'] = $_POST['fname'];
    $userData['lname'] = $_POST['lname'];
    
    $addressData['street_name'] = $_POST['street_name'];
    $addressData['street_nb'] = $_POST['street_nb'];
    $addressData['city'] = $_POST['city'];
    $addressData['province'] = $_POST['province'];
    $addressData['zipcode'] = $_POST['zipcode'];
    $addressData['country'] = $_POST['country'];

    if (empty($errors)) {
        try {
            if ($inscriptionModel->createUser($userData, $addressData)) {
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['user'] = $userData;
                // Redirection vers home.php
                header('Location: home.php');
                exit();
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
