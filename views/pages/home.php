<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Accueil</title>
    <link rel="stylesheet" href="../css/home.css"> 
</head>

<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <a href="panier.php">
                    <img id="cart-icon" src="../images/cart-icon.png" alt="Panier">
                    <span id="cart-count"><?php echo isset($_SESSION['panier']) ? count($_SESSION['panier']) : 0; ?></span>
                </a>
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="accueil.php">Accueil</a></li>
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="login.php">Connexion</a></li>
            <li><a href="panier.php">Panier</a></li>
        </ul>
    </nav>

    <main>
        <div class="banner">
            <img src="../images/image.png" alt="Bannière Teccart Wear">
        </div>
        <p>Bienvenue sur la page d'accueil de Teccart Wear.</p>

        <section class="new-products">
            <h2>Nouveaux Produits</h2>
            <?php
            foreach ($newProducts as $product) {
                echo '<div class="product">';
                echo '<h3>' . $product['name'] . '</h3>';
                echo '<p>' . $product['description'] . '</p>';
                echo '<p>Prix: $' . number_format($product['price'], 2) . '</p>';
                echo '<img src="' . $product['url_img'] . '" alt="' . $product['name'] . '">';
                echo '<button>Ajouter au panier</button>';
                echo '</div>';
            }
            ?>
        </section>


    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Teccart Wear. Tous droits réservés.</p>
    </footer>
</body>

</html>
