<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// inclure des fichiers de base de données et d'objets
require_once './libs/data_base.php';
require_once './objets/produits.php';


// prépare un objet produit
$product = new Product($bdd);

// définir la propriété ID de l'enregistrement à lire
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

// lit les détails du produit à éditer
$product->readOne();

if ($product->name != null) {
    // crée un tableau
    $product_arr = array(
        "id_product" =>  $product->id,
        "name" => $product->name,
        "ref" => $product->ref,
        "quantity" => $product->quantity,
        "price" => $product->price,
        "fournisseur_id" => $product->id_four,
        "fournisseur_name" => $four->id_four,

    );

    // le code de réponse - 200 OK
    http_response_code(200);

    // rend le format json
    echo json_encode($product_arr);
} else {
    // code de réponse - 404 Introuvable
    http_response_code(404);

    // message le produit n'existe pas
    echo json_encode(array("message" => "Le produit n'existe pas."));
}
