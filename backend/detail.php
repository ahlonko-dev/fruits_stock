<?php
require "./libs/data_base.php";
require "./libs/cors.php";

header('Content-Type: application/json');
cors();

$json = [
    "erreur"         => true, /* indique si il y a une erreur ou non */
    "erreur_message" => "unknow error", /* il indique le message d'erreur pour les front */
    $json['product'] = "" /* il sert à afficher se qu'on envoie aux front - les données de réponses */
];

if (isset($_REQUEST["id_product"]) and !empty($_REQUEST["id_product"])) {
    //on va créer la variable
    $id_product = intval($_REQUEST["id_product"]);
    $sql = "SELECT * FROM produits WHERE id_product = :id_product;";
    //on fait une requête dans la sql
    $requete = $bdd->prepare($sql);
    //poser lasécurité sur la variable qu'on récupère sur le IF 
    $requete->bindValue(":id_product", $id_product, PDO::PARAM_INT);
    //onexecute la fonction
    $requete->execute();
    //on verifie si la requete à trouvé une réponse dans la table
    if ($requete && $requete->rowCount() == 1) {
        $row = $requete->fetch();

        $json['erreur'] = false;
        $json['erreur_message'] = "";
        $json['product']['id_product'] = $row['id_product'];
        $json['product']['name'] = $row['name'];
        $json['product']['price'] = $row['price'];
        $json['product']['quantity'] = $row['qty'];
        $json['product']['reference'] = $row['ref'];
    } else {
        $json['erreur_message'] = "pas de contenu trouvé dans la table";
    }
} else {
    $json['erreur_message'] = "On a pas obtenu id du produit";
}
echo json_encode($json);