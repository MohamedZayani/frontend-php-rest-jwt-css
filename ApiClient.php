<?php
if (!isset($_COOKIE['jwt'])) {
    header('Location: index.php');
    exit;
}
class ApiClient {
    private $baseUrl;
    private $token;

    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
        $this->token = $_COOKIE['jwt'];
    }

    // Authentification pour obtenir le JWT
    public function authenticate($username, $password) {
        $url = $this->baseUrl . '/auth/login';
        $data = http_build_query(['username' => $username, 'password' => $password]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode === 200) {
            $this->token = $response; // Le token JWT
        } else {
            throw new Exception('Erreur d\'authentification : ' . $response);
        }

        curl_close($ch);
    }

    // Envoyer une requête GET
    public function get($endpoint) {
        $url = $this->baseUrl . $endpoint;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200) {
            return json_decode($response, true);
        } else {
            throw new Exception('Erreur : ' . $response);
        }
    }

    // Envoyer une requête POST
    public function post($endpoint, $data) {
        $url = $this->baseUrl . $endpoint;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->token,
            'Content-Type: application/json',
            'Accept: application/json'
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 200 || $httpCode === 201) {
            return json_decode($response, true);
        } else {
            throw new Exception('Erreur : ' . $response);
        }
    }

 // Envoyer une requête PUT
 public function put($endpoint, $data) {
    $url = $this->baseUrl . $endpoint;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $this->token,
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 || $httpCode === 201) {
        return json_decode($response, true);
    } else {
        throw new Exception('Erreur : ' . $response);
    }    
}

// Envoyer une requête DELETE
public function delete($endpoint) {
    $url = $this->baseUrl . $endpoint;

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $this->token,
        'Content-Type: application/json',
        'Accept: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        return json_decode($response, true);
    } 
}


}
// référence l'endpoint de l'API de gestion des personnes du tp8
$client = new ApiClient("http://localhost:8888/produits");

?>