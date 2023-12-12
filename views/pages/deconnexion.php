<?php
session_start();
session_destroy();
header('Location: login.php'); // Redirigez vers la page de connexion ou une autre page de votre choix
exit;
?>