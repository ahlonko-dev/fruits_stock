<?php
require "./libs/data_base.php";
require "./libs/cors.php";
header('Content-Type: application/json');
cors();
/* session_start(); */
if (
    isset($_REQUEST['id_product']) and !empty($_REQUEST['id_product'])
    and isset($_REQUEST['name']) and !empty($_REQUEST['name'])
    and isset($_REQUEST['price']) and !empty($_REQUEST['price'])
    and isset($_REQUEST['qty']) and !empty($_REQUEST['qty'])
    and isset($_REQUEST['ref']) and !empty($_REQUEST['ref'])
) {
    $json = [
        "erreur"                 => true, /* indique si il y a une erreur ou non */
        "erreur_message"         => "Pas encore de données", /* il indique le message d'erreur pour les front */
        "update" => ""
    ];
    $id_product = intval($_REQUEST['id_product']);
    $name = ($_REQUEST['name']);
    $price = ($_REQUEST['price']);
    $qty = ($_REQUEST['qty']);
    $ref = ($_REQUEST['ref']);
    $up_requeser  = $bdd->prepare("UPDATE produits 
                                SET name =:name, 
                                    price =:price,
                                    qty =:qty,
                                    ref =:ref
                                     WHERE id_product =:id_product");
    $up_requeser->bindValue(":id_product", $id_product, PDO::PARAM_INT);
    $up_requeser->bindValue(":name", $name, PDO::PARAM_STR);
    $up_requeser->bindValue(":qty", $qty, PDO::PARAM_STR);
    $up_requeser->bindValue(":price", $price, PDO::PARAM_STR);
    $up_requeser->bindValue(":ref", $ref, PDO::PARAM_STR);

    $up_requeser->execute();
    if ($up_requeser) {
        $json['erreur'] = false;
        $json['update'] = "success";
        $json['erreur_message'] = "Pas d'erreur";
    } else {
        $json['erreur_message'] = "erreur mis à jour";
    }
} else {
    $json['erreur'] = true;
    $json['erreur_message'] = "You must send this param with POST: id_product, name, price, qty";
    // die("erreur not get id_product");
}

echo json_encode($json);