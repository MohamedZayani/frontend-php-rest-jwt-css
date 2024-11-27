<?php
require_once('ApiClient.php');
// récupérer tous les objets de type "Produit"
$produits = $client->get("");
//print_r($produits);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <!-- inclure la barre de navigation -->
    <?php include 'navBar.html'; ?>

    <!-- Contenu principal -->
    <div class="content">
              <h2>Liste des produits</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($produits as $produit): ?>
                    <tr>
                        <td><?php echo htmlspecialchars(isset($produit['id']) ? $produit['id'] : $produit); ?></td>
                        <td><?php echo htmlspecialchars(isset($produit['nom']) ? $produit['nom'] : $produit); ?></td>
                        <td><?php echo htmlspecialchars(isset($produit['prix']) ? $produit['prix'] : $produit); ?></td>
                        <td>
                            <!-- Lien vers le formulaire d'édition -->
                            <a
                                href="edit.php?id=<?php echo isset($produit['id']) ? $produit['id'] : $produit; ?>">Éditer</a>
                        </td>
                        <td>
                            <!-- Lien pour supprimer avec confirmation -->
                            <a href="delete.php?id=<?php echo isset($produit['id']) ? $produit['id'] : $produit; ?>"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>



            </tbody>
        </table>


        
      
    </div>
</body>

</html>