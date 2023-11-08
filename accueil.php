<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Teccart Wear - Accueil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        header {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        nav {
            background-color: #333;
            color: #fff;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        .product {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            display: inline-block;
            width: 30%;
        }
        .product img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Teccart Wear</h1>
    </header>
    <nav>
        <!-- navbar avec onglet pour style de vetement -->
        <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Femmes</a></li>
            <li><a href="#">Hommes</a></li>
            <li><a href="#">Enfants</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <!-- div pour ajouter mes produits -->
    <div class="product">
        <img src="chemise.jpg" alt="Chemise élégante">
        <h3>Chemise Élégante</h3>
        <p>Prix : $29.99</p>
        <a href="#">Acheter</a>
    </div>
    <div class="product">
        <img src="robe.jpg" alt="Robe d'été">
        <h3>Robe d'Été</h3>
        <p>Prix : $39.99</p>
        <a href="#">Acheter</a>
    </div>
    <div class="product">
        <img src="jeans.jpg" alt="Jeans classiques">
        <h3>Jeans Classiques</h3>
        <p>Prix : $49.99</p>
        <a href="#">Acheter</a>
    </div>
   
</body>
</html>
