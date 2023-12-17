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
                $userId = $this->model->createUser($userData, $addressData);

                if ($userId) {
                    // Démarre la session et stock les informations de l'utilisateur, y compris l'ID
                    session_start();
                    $_SESSION['user'] = [
                        'id' => $userId,
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
        // Vérifie que les champs essentiels ne sont pas vides
        if (empty($userData['email']) || empty($userData['password']) || 
            empty($userData['fname']) || empty($userData['lname'])) {
            return false;
        }
        if (empty($userData['username'])) {
            return false;
        }
    
        // Vérifie que l'email est valide
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            return false;
        }
    
        // Vérifie la longueur du mot de passe (au moins 6 caractères)
        if (strlen($userData['password']) < 6) {
            return false;
        }
    
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
