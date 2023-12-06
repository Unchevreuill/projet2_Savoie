<?php

class LoginController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function showLoginForm() {
        // Render the login form view
        $this->view->renderLoginForm();
    }

    public function processLogin($email, $password) {
        // Validate and process login logic
        $loginResult = $this->model->processLogin($email, $password);

        // Redirect based on login result
        if ($loginResult) {
            // Login successful, redirect to home page
            header('Location: /php2/projet2_Savoie/index.php');
            exit();
        } else {
            // Login failed, redirect back to login page with an error
            header('Location: /php2/projet2_Savoie/pages/login.php?error=1');
            exit();
        }
    }
}
