<?php
require_once('ApiClient.php');
// Récupération de l'ID passé en paramètre GET dans l'URL
$idProduit = isset($_GET['id']) ? $_GET['id'] : null;

//en cas de l'existence d'un id 
if ($idProduit !== null )
{
// suppression de l'objet 'Personne' ayant l'id reçu en paramètre
$dataGetById = $client->delete("/".$idProduit);
}
  
    // redirection vers une page de liste
    header("Location: list.php");      
    exit();

?>