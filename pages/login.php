<!DOCTYPE html>
<html>
<head>
    <title>Page de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
        }
        label, input {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="process_login.php" method="post">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
