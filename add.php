<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" type="text/css"
	href="css/style.css" />
</head>
<body>
<?php require_once('ApiClient.php'); ?>
<!-- inclure la barre de navigation -->
<?php include 'navBar.html'; ?>
<!-- Contenu principal -->
<div class="content">

<form action="add.php" method="POST">
    <label for="id">ID :</label>
    <input type="number" id="id" name="id" required>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prix">Prix :</label>
    <input type="number" id="prix" name="prix" required>

    <input type="submit" value="Ajouter">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];

    // Préparer les données à envoyer à l'API
    $produitData = [
        'id' => $id,
        'nom' => $nom,
        'prix' => $prix
    ];

     // insérer le produit à travers l'API REST
     $responsePost = $client->post("", $produitData);

      
    // redirection vers une page de liste
    header("Location: list.php");      
    exit();
}
?>
</div>
</body>
</html>
