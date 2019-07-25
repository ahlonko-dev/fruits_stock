<?php
// require headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// inclure les fichiers de base de données et d'objets
require_once './libs/data_base.php';
require_once './objets/produits.php';

// initialise l'objet
$product = new Produits($bdd);

// obtenir des mots-clés
$keywords = isset($_GET["search"]) ? $_GET["search"] : "";

// interroger les produits
$stmt = $product->search($keywords);
$num = $stmt->rowCount();

// vérifie si plus de 0 enregistrement trouvé
if ($num > 0) {

    // tableau de produits
    $products_arr = array();
    $products_arr["product"] = array();

    // récupère le contenu de notre table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extrait la ligne
        extract($row);

        $product_item = array(
            "id_product" => $id_product,
            "name" => $name,
            "price" => $price,
            "ref" => $ref,
            "quantity" => $qty
        );

        array_push($products_arr["product"], $product_item);
    }

    // définir le code de réponse - 200 OK
    http_response_code(200);

    // affiche les données sur les produits
    echo json_encode($products_arr);
} else {
    // définir le code de réponse - 404 Introuvable
    http_response_code(404);

    // message au frontend (aucun produit trouvé)
    echo json_encode(
        array("message" => "Pas de produits trouvé.")
    );
}
