<?php
require "./libs/data_base.php";
require "./libs/cors.php";
header('Content-Type: application/json');
cors();
session_start();
if (
    isset($_REQUEST['id_product']) and !empty($_REQUEST['id_product'])
    and isset($_REQUEST['new_name']) and !empty($_REQUEST['new_name'])
    and isset($_REQUEST['new_price']) and !empty($_REQUEST['new_price'])
    and isset($_REQUEST['new_qty']) and !empty($_REQUEST['new_qty'])
    and isset($_REQUEST['new_ref']) and !empty($_REQUEST['new_ref'])
) {
    $json = [
        "erreur"                 => true, /* indique si il y a une erreur ou non */
        "erreur_message"         => "Pas encore de données", /* il indique le message d'erreur pour les front */
        "update" => ""
    ];
    $id_product = intval($_REQUEST['id_product']);
    $name = ($_REQUEST['id_product']);
    $price = ($_REQUEST['new_price']);
    $qty = ($_REQUEST['new_qty']);
    $ref = ($_REQUEST['new_ref']);

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
        $json['update'] = "ok";
        $json['erreur_message'] = "";
    } else {
        $json['erreur_message'] = "erreur mis à jour";
    }
} else {
    $json['erreur'] = true;
    $json['erreur_message'] = "You must send this param with POST: id_product, new_name, new_price, new_qty";
    // die("erreur not get id_product");
}

echo json_encode($json);