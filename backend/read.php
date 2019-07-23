<?php
// require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include Connextion base de donnee 
// include base de donnee et fichier obets
require_once './libs/data_base.php';
require_once './objets/produits.php';

// instantiate base de donnee et produits objets 
$database = new Database();
$db = $database->getConnection();

// initialize objets
$product = new Produits($db);


// query produits
$stmt = $product->read();
$num = $stmt->rowCount();

// verifie si un fichier en enregistrer dans la base de donnee
if ($num > 0) {

    // produits array
    $products_arr = array();
    $products_arr["produits"] = array();

    // boucle pour afichez 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extrait row
        extract($row);

        $product_item = array(
            "id_produit" => $id_produit,
            "nom" => $nom,
            "reference" => $ref,
            "quantite" => $qte,
            "prix" => $prix,
        );

        array_push($products_arr["produits"], $product_item);
    }

    // reponse code - 200 OK
    http_response_code(200);

    // aficchez les products au format json
    echo json_encode($products_arr);
} else {

    // reponse code - 404 Not found
    http_response_code(404);

    // pas de produit trouver
    echo json_encode(
        array("message" => "Pas de produit trouver.")
    );
}
