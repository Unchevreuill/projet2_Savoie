<?php
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/projet2_Savoie/';

    $classFile = str_replace('\\', '/', $class) . '.php';
    $filePath = $baseDir . $classFile;

    if (file_exists($filePath)) {
        require_once $filePath;
    }
});
?>