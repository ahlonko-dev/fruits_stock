<?php
require "./libs/cors.php";
cors();
require "./libs/data_base.php";
header('Content-Type: application/json');

 $json = [
    "error"         => true, /* indique si il y a une erreur ou non */
    "error_message" => "Uknown error", /* il indique le message d'erreur pour les front */
    "data"          => "" /* il sert à afficher se qu'on envoie aux front - les données de réponses */
];


 //si isset 
 $sql = "SELECT nom, qte, prix
        FROM produits;";
$requete = $bdd->prepare($sql);
$requete->execute();
// on vérifie si il y a des données de la requête SQL (1 seul résultat) 
if ($requete && $requete->rowCount() == 1) {
    $row = $requete->fetch();
    $json["data"] = $row["nom"];
    $json["data"] = $row["qte"];
     $json["data"] = $row["nom"];
    $json["error"] = false;
    //on dit qu'il n'y a pas d'erreur donc pas de message d'erreur
   $json["error_message"] = "";
} else {
    //on affiche le message si la condition n'est pas remplie (pas d'entrées djson ce cas)
    $json["error_message"] = "Pas de données json la table";
}  
echo json_encode($json);
die();