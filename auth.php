<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $apiUrl = 'http://localhost:8888/auth/login'; // URL de l'API

    // Préparer la requête cURL
    $ch = curl_init($apiUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper('POST'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'username' => $username,
        'password' => $password
    ]));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $token = trim($response);

        // Stocker le JWT dans un cookie sécurisé ( expirant dans 1 jour)
        setcookie('jwt', $token, time() + 86400, "/", "", false, false);

        // Rediriger vers le tableau de bord
        header('Location: list.php');
        exit;
    } else {
        $erreur= "Erreur d'authentification. Veuillez réessayer.";
         // Rediriger vers l'index
         header('Location: index.php');
    }
}
?>
