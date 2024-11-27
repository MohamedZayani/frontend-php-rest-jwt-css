
<?php
// Configuration de la base de données
$host = "localhost";
$dbname = "messages_db";
$username = "root"; 
$password = "";     

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = trim($_POST['message']);
    if (!empty($message)) {
        // Insérer le message dans la base de données
        $stmt = $pdo->prepare("INSERT INTO messages (message) VALUES (:message)");
        $stmt->execute(['message' => $message]);
    }
}

// Récupérer tous les messages depuis la base de données
$stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages avec base de données</title>
    <link rel="stylesheet" type="text/css"
	href="css/style.css" />
</head>
<body>
    <!-- inclure la barre de navigation -->
<?php include 'navBar.html'; ?>
<!-- Contenu principal -->
<div class="content">
    <h1>Saisir un message</h1>
    <form method="POST">
        <textarea name="message" rows="4" cols="50" placeholder="Écrivez votre message ici..." required></textarea><br>
        <input type="submit" value="Envoyer">
    </form>
     <div>
    <h1>Messages enregistrés</h1>
    <ul>
        <?php
        // Afficher les messages stockés
        if (!empty($messages)) {
            foreach ($messages as $msg) {
                echo "<li>" .  $msg['message'] ; 
                     " <em>(" . $msg['created_at'] . ")</em></li>";
            }
        } else {
            echo "<li>Aucun message pour le moment.</li>";
        }
        ?>
    </ul>
    </div>
    </div>
</body>
</html>
