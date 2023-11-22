<?php
// Vous pouvez inclure ici des fichiers communs ou des configurations nécessaires pour votre projet
session_start(); // Démarrez la session si elle n'a pas encore été démarrée
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Accueil</title>
    <!-- Vous pouvez inclure ici des liens vers des fichiers CSS ou d'autres ressources -->
    <link rel="stylesheet" href="css/style.css"> <!-- Ajoutez vos propres fichiers CSS -->
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="pages/panier.php">
                    <img id="cart-icon" src="images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0; ?></span>
                </a>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="pages/accueil.php">Accueil</a></li>
            <li><a href="pages/inscription.php">Inscription</a></li>
            <li><a href="pages/login.php">Connexion</a></li>
            <li><a href="pages/panier.php">Panier</a></li>
        
        </ul>
    </nav>

    <main>
        <p>Bienvenue sur la page d'accueil de Teccart Wear.</p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>
</html>
