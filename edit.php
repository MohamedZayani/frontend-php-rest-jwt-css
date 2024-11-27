<?php
require_once('ApiClient.php');
// Récupération de l'ID passé en paramètre GET dans l'URL
$idProduit = isset($_GET['id']) ? $_GET['id'] : null;

//en cas de l'existence d'un ID
if ($idProduit !== null )
{
// Récupération de l'objet 'Produit' ayant l'ID reçu en paramètre
$dataGetById = $client->get("/". $idProduit);
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les nouvelles valeurs du formulaire
    $produitUpdated = [
        "id" => (int)$_POST['id'],
        "nom" => $_POST['nom'],
        "prix" => (int)$_POST['prix']
    ];

    // print_r($produitUpdated);
    // Mettre à jour les informations de "Produit" à travers l'API REST
     $responsePut = $client->put("/".$produitUpdated['id'], $produitUpdated);

      
    // redirection vers une page de liste
    header("Location: list.php");      
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer un produit</title>
    <link rel="stylesheet" type="text/css"
	href="css/style.css" />
        
    
</head>
<body>
<!-- inclure la barre de navigation -->
<?php include 'navBar.html'; ?>
<!-- Contenu principal -->
<div class="content">
    
 <form method="post" action="edit.php">
    <input type="hidden" id="id" name="id" value="<?php echo htmlspecialchars($dataGetById['id']); ?>" ><br><br>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($dataGetById['nom']); ?>" required><br><br>

    <label for="age">Âge :</label>
    <input type="text" id="prix" name="prix" value="<?php echo htmlspecialchars($dataGetById['prix']); ?>" required><br><br>

    <input type="submit" value="Modifier">
</form>
</div>

</body>
</html>
