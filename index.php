<?php
// Include the file for class autoloading
include_once 'autoload.php';

// Include the database configuration file
include_once 'utils/DBConfig.php';

// Start the session
session_start();

// Check if the user is not logged in, redirect to the home page
if (!isset($_SESSION['user_id'])) {
    header('Location: projet2_Savoie/views/pages/home.php');
    exit();
}

include_once 'views/pages/home.php';
?>
