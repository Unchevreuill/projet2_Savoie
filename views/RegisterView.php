<?php

class RegisterView {
    public function showRegistrationForm($name, $email, $password, $nameError, $emailError, $passwordError, $registrationError) {
        // Display the registration form
        echo '<div class="container">';
        
        echo '<h2>Registration</h2>';

        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
        
        echo '<div class="form-group">';
        echo '<label for="name">Name:</label>';
        echo '<input type="text" id="name" name="name" class="input-field" value="' . htmlspecialchars($name) . '">';
        echo '<span class="error">' . htmlspecialchars($nameError) . '</span>';
        echo '</div>';

        echo '<div class="form-group">';
        echo '<label for="email">Email:</label>';
        echo '<input type="email" id="email" name="email" class="input-field" value="' . htmlspecialchars($email) . '">';
        echo '<span class="error">' . htmlspecialchars($emailError) . '</span>';
        echo '</div>';

        echo '<div class="form-group">';
        echo '<label for="password">Password:</label>';
        echo '<input type="password" id="password" name="password" class="input-field" value="' . htmlspecialchars($password) . '">';
        echo '<span class="error">' . htmlspecialchars($passwordError) . '</span>';
        echo '</div>';

        echo '<div class="form-group">';
        echo '<input type="submit" name="inscription" value="Register" class="register-button">';
        echo '</div>';

        echo '<span class="error">' . htmlspecialchars($registrationError) . '</span>';

        echo '</form>';

        echo '<p>Already have an account? <a href="../pages/login.php">Login here</a>.</p>';
        
        echo '</div>';
    }
}
