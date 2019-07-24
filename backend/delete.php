<?php
// require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// inclure la base de données et le fichier objet
require_once './libs/data_base.php';
require_once './objets/produits.php';



// prépare produit
$product = new Produits($bdd);

// obtenir l'id du produit
//$data = json_decode(file_get_contents("php://input"));
$data = $_GET['id_produit'];;

// définir de l'id du produit à supprimer
//$product->id_produit = $data->id_produit;
$product->id_produit = $data;


// supprime le produit
if ($product->delete()) {

    // reponse code - 200 ok
    http_response_code(200);

    // Message en retour 
    echo json_encode(array("message" => "Le produit a été supprimé."));
}

// si  c'est impossible de supprimer le produit
else {

    // reponse code - 503 Service indisponible
    http_response_code(503);

    // Message en retour au frontend
    echo json_encode(array("message" => "Impossible de supprimer le produit."));
}
