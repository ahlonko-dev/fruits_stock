<?php
// require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include Connextion base de donnee 
// include base de donnee et fichier obets
require_once './libs/data_base.php';
require_once './objets/produits.php';


// initialize objets
$product = new Produits($bdd);


// query produits
$stmt = $product->read();
$num = $stmt->rowCount();

// verifie si un fichier en enregistrer dans la base de donnee
if ($num > 0) {

    // produits array
    $products_arr = array();
    $products_arr["products"] = array();

    // boucle pour afichez 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extrait row
        extract($row);

        $product_item = array(
            "id_product" => $id_product,
            "name" => $name,
            "ref" => $ref,
            "quantity" => $qty,
            "price" => $price,
        );

        array_push($products_arr["products"], $product_item);
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
