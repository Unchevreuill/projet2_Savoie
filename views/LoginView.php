<?php

class LoginView {
    public function showLoginForm($email, $emailError, $passwordError, $loginError) {
        // Display the login form
        echo '<div class="container">';
        
        echo '<h2>Login</h2>';

        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        
        echo '<div class="form-group">';
        echo '<label for="email">Email:</label>';
        echo '<input type="email" id="email" name="email" class="input-field" value="' . htmlspecialchars($email) . '">';
        echo '<span class="error">' . htmlspecialchars($emailError) . '</span>';
        echo '</div>';

        echo '<div class="form-group">';
        echo '<label for="password">Password:</label>';
        echo '<input type="password" id="password" name="password" class="input-field">';
        echo '<span class="error">' . htmlspecialchars($passwordError) . '</span>';
        echo '</div>';

        echo '<div class="form-group">';
        echo '<input type="submit" name="connexion" value="Login" class="login-button">';
        echo '</div>';

        echo '<span class="error">' . htmlspecialchars($loginError) . '</span>';

        echo '</form>';

        echo '<p>Not registered yet? <a href="../pages/inscription.php">Sign up here</a>.</p>';
        
        echo '</div>';
    }
}
