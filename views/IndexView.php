<?php
class IndexView {
    public function render($data) {
        // HTML code for the index view
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Index - Teccart Wear</title>
            <!-- Add your CSS and other head elements here -->
        </head>
        <body>
            <header>
                <div class="header-content">
                    <h1>Teccart Wear</h1>
                </div>
            </header>
            
            <div class="container">
                <h2>Index</h2>
                <!-- Add your index content here -->
                <p>Welcome to Teccart Wear! Explore our amazing collection.</p>
            </div>

            <footer>
                <p>&copy; 2023 Teccart Wear. All rights reserved.</p>
            </footer>
        </body>
        </html>
        <?php
    }
}
?>
