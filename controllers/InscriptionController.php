<?php

namespace projet2_Savoie\Controllers;

use Exception;
use projet2_Savoie\models\InscriptionModel;

class InscriptionController
{
    private $model;

    public function __construct(InscriptionModel $model)
    {
        $this->model = $model;
    }

    public function createUser($userData, $addressData)
    {
        if ($this->validateUserData($userData) && $this->validateAddressData($addressData)) {
            try {
                $result = $this->model->createUser($userData, $addressData);

                if ($result) {
                    // Démarrer la session et stocker les informations de l'utilisateur
                    session_start();
                    $_SESSION['user'] = [
                        'fname' => $userData['fname'], 
                        'lname' => $userData['lname']
                    ];

                    // Redirection vers la page d'accueil
                    header('Location: home.php');
                } else {
                    echo 'Échec de l\'inscription. Veuillez réessayer.';
                }
            } catch (Exception $e) {
                echo 'Erreur lors de l\'inscription: ' . $e->getMessage();
            }
        } else {
            echo 'Données d\'inscription ou d\'adresse invalides.';
        }
    }
    private function validateUserData($userData)
    {
        // Vérifiez que les champs essentiels ne sont pas vides
        if (empty($userData['email']) || empty($userData['password']) || 
            empty($userData['fname']) || empty($userData['lname'])) {
            return false;
        }
        if (empty($userData['username'])) {
            return false;
        }
    
        // Vérifiez que l'email est valide
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
    
        // Vérifiez la longueur du mot de passe (par exemple, au moins 6 caractères)
        if (strlen($userData['password']) < 6) {
            return false;
        }
    
        // Ajoutez ici d'autres validations selon vos besoins
    
        return true;
    }
    
    private function validateAddressData($addressData)
    {
        // Vérifiez que les champs essentiels ne sont pas vides
        if (empty($addressData['street_name']) || empty($addressData['street_nb']) || 
            empty($addressData['city']) || empty($addressData['province']) || 
            empty($addressData['zipcode']) || empty($addressData['country'])) {
            return false;
        } 
        return true;
    }
    
}

?>
