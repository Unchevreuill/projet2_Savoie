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

    public function processLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connexion'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Validate email and password (add your validation logic here)

            // Retrieve user information based on email
            $user = $this->userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['pwd'])) {
                // Authentication successful, store user information in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                // Redirect to home page or any other desired page
                header('Location: home.php');
                exit();
            } else {
                // Authentication failed, set login error message
                $this->loginView->setLoginError('Identifiants invalides. Veuillez réessayer.');
            }
        }

        // Render the login page
        $this->loginView->render();
    }
}
