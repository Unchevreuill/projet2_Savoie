<?php
namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\UserModel;
use projet2_Savoie\Views\LoginView;

class LoginController
{
    private $userModel;
    private $loginView;

    public function __construct(UserModel $userModel, LoginView $loginView)
    {
        $this->userModel = $userModel;
        $this->loginView = $loginView;
    }

    public function index()
    {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["connexion"])) {
            // Perform login logic
            $this->performLogin();
        }

        // Render the login view
        $this->loginView->render();
    }

    private function performLogin()
    {
        // Retrieve user input
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Validate email and password (you can add more validation)
        if (empty($email)) {
            $this->loginView->setLoginError("Veuillez saisir votre adresse e-mail.");
            return;
        }

        if (empty($password)) {
            $this->loginView->setLoginError("Veuillez saisir votre mot de passe.");
            return;
        }

        // Check user credentials
        $user = $this->userModel->getUserByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Login successful, redirect or perform other actions
            // For example, you can set a session variable to indicate the user is logged in
            $_SESSION['user_id'] = $user['id'];
            // Redirect to another page
            header('Location: /php2/projet2_Savoie/views/pages/home.php');
            exit();
        } else {
            // Login failed, display error message
            $this->loginView->setLoginError("Adresse e-mail ou mot de passe incorrect.");
        }
    }
}
