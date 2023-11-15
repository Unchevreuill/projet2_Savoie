<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teccart Wear - Accueil</title>
    <link rel="stylesheet" href="../css/accueil.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Teccart Wear</h1>
            <div class="cart">
                <span id="cart-count">0</span>
                <img src="../images/cart-icon.png" alt="Shopping Cart" id="cart-icon">
            </div>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Femmes</a></li>
            <li><a href="#">Hommes</a></li>
            <li><a href="#">Enfants</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <div class="login-button">
            <a href="../pages/login.php">Connexion</a>
        </div>
    </nav>
    <div class="container">
        <div class="product" onclick="addToCart('Chemise Élégante', 29.99)">
            <img src="../images/chemise.jpg" alt="Elegant Blue Dress Shirt">
            <h3>Chemise Élégante</h3>
            <p>Prix : $29.99</p>
            <a href="#">Acheter</a>
        </div>
        <div class="product" onclick="addToCart('Robe d\'Été', 39.99)">
            <img src="../images/robe.jpg" alt="Casual Summer Dress">
            <h3>Robe d'Été</h3>
            <p>Prix : $39.99</p>
            <a href="#">Acheter</a>
        </div>
        <div class="product" onclick="addToCart('Jeans Classiques', 49.99)">
            <img src="../images/jeans.jpg" alt="Classic Denim Jeans">
            <h3>Jeans Classiques</h3>
            <p>Prix : $49.99</p>
            <a href="#">Acheter</a>
        </div>
        <!-- Add more products here if needed -->
    </div>
    <footer>
        <p>&copy; 2023 Teccart Wear. Tous droits réservés.</p>
    </footer>
    <script>
        let cartCount = 0;

        function addToCart(productName, price) {
            cartCount++;
            updateCartCount(cartCount);
            console.log(`Added ${productName} to the cart. Price: $${price}`);
        }

        function updateCartCount(count) {
            document.getElementById('cart-count').innerText = count;
        }
    </script>
</body>
</html>
