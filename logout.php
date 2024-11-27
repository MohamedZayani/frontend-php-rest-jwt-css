<?php
setcookie('jwt', '', time() - 3600, "/"); // Supprimer le cookie
header('Location: index.php'); // Rediriger vers la page de connexion
exit;
?>