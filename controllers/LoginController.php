<?php
namespace projet2_Savoie\Controllers;

use projet2_Savoie\Models\LoginModel;
use projet2_Savoie\Views\LoginView;

class LoginController
{
    private $model;
    private $view;

    public function __construct(LoginModel $model, LoginView $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function index()
    {
        // Handle the login form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["connexion"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Call the model method to check login
            $loginSuccessful = $this->model->checkLogin($email, $password);

            if ($loginSuccessful) {
                // Redirect to a different page on successful login
                header("Location: /php2/projet2_Savoie/views/pages/home.php");
                exit();
            } else {
                // Display login error in the view
                $this->view->setLoginError("Invalid email or password. Please try again.");
            }
        }

        // Render the login view
        $this->view->render();
    }
}
