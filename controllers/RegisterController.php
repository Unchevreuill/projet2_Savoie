<?php

class RegisterController {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function showRegistrationForm() {
        // Render the registration form view
        $this->view->renderRegistrationForm();
    }

    public function processRegistration($email, $password, $confirmPassword) {
        // Validate and process registration logic
        $registrationResult = $this->model->processRegistration($email, $password, $confirmPassword);

        // Redirect based on registration result
        if ($registrationResult) {
            // Registration successful, redirect to home page or login page
            header('Location: /php2/projet2_Savoie/index.php');
            exit();
        } else {
            // Registration failed, redirect back to registration page with an error
            header('Location: /php2/projet2_Savoie/pages/inscription.php?error=1');
            exit();
        }
    }
}
