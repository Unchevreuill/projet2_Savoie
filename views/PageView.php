<?php

namespace projet2_Savoie\Views;

class PageView
{
    public function render($page, $data = [])
    {
        // Inclure l'en-tête commun
        include_once 'common/header.php';

        // Inclure le contenu de la page spécifique
        include_once "pages/$page.php";

        // Inclure le pied de page commun
        include_once 'common/footer.php';
    }
}
