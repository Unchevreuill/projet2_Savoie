<?php
spl_autoload_register(function ($class) {
    $baseNamespace = 'projet2_Savoie\\';
    // Répertoire de base 
    $baseDir = __DIR__ . '/';
    // Vérifie si la classe utilise le préfixe de l'espace de noms
    $len = strlen($baseNamespace);
    if (strncmp($baseNamespace, $class, $len) !== 0) {
        // Si la classe n'utilise pas le préfixe, passez au prochain autoloader enregistré
        return;
    }
    // Obtenir le nom de classe relatif
    $relativeClass = substr($class, $len);

    
    // séparateurs par des séparateurs de répertoire dans le nom de classe relatif, ajoutez .php
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Si le fichier existe, exigez-le
    if (file_exists($file)) {
        require $file;
    }
});
