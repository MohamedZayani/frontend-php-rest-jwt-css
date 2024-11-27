<?php 
// Vérifier si le token est déjà dans la cookie 
if (isset($_COOKIE['jwt'])) { header('Location: list.php');
    exit; } 
    ?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Authentification</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>

    <body>


        <!-- Contenu principal -->
        <div class="content">
            <form id="login-form" method="POST" action="auth.php">
                <label for="username">Nom d'utilisateur :</label><br>
                <input type="text" id="username" name="username" required><br><br>

                <label for="password">Mot de passe :</label><br>
                <input type="password" id="password" name="password" required><br><br>

                <input type="submit"  value ="Se connecter"></input>
            </form>
        </div>
    </body>

    </html>