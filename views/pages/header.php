<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear</title>
    <!-- Ajoutez des liens vers vos fichiers CSS ou d'autres ressources ici -->
    <link rel="stylesheet" href="chemin/vers/votre/style.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <!-- Utilisez des chemins relatifs pour les liens -->
                <a href="pages/panier.php">
                    <img id="cart-icon" src="images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0; ?></span>
                </a>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <!-- Utilisez des chemins relatifs pour les liens -->
            <li><a href="/php2/projet2_Savoie/views/pages/accueil.php">Accueil</a></li>
            <li><a href="/php2/projet2_Savoie/views/pages/inscription.php">Inscription</a></li>
            <li><a href="/php2/projet2_Savoie/views/pages/login.php">Connexion</a></li>
            <li><a href="/php2/projet2_Savoie/views/pages/panier.php">Panier</a></li>
        </ul>
    </nav>
