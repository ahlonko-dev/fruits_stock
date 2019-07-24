<?php
require "./libs/data_base.php";
require "./libs/cors.php";
header('Content-Type: application/json');
cors();
session_start();
if (isset($_REQUEST['id_product']) and !empty($_REQUEST['id_product'])) {
    $id_product = intval($_REQUEST['id_product']);
    $requser = $bdd->prepare("SELECT * FROM produits WHERE id_product =:id_product");
    $requser->bindValue(":id_product", $id_product, PDO::PARAM_INT);
    // $requser->execute(array($_SESSION['id_product']));
    $product = $requser->fetch();
    $json = [
        "erreur"                 => true, /* indique si il y a une erreur ou non */
        "erreur_message"         => "Pas encore de données", /* il indique le message d'erreur pour les front */
        "data_new_name"       => "", /* il sert à afficher se qu'on envoie aux front - les données de réponses */
        "data_new_price"       => "", /* il sert à afficher se qu'on envoie aux front - les données de réponses */
        "data_new_ref"       => "", /* il sert à afficher se qu'on envoie aux front - les données de réponses */
        "data_new_qty"       => "" /* il sert à afficher se qu'on envoie aux front - les données de réponses */
    ];
    if (
        isset($_REQUEST['newname'])
        and !empty($_REQUEST['newname'])
        and $_REQUEST['newname'] != $product['name']
    ) {
        $newname      = htmlspecialchars($_REQUEST['newname']);
        $newname   = $bdd->prepare("UPDATE produits SET name = ? WHERE id_product =:id_product");
        $requser->bindValue(":id_product", $id_product, PDO::PARAM_INT);
        $upnewname->execute(array($newname, $_SESSION['id_produit']));
        if ($upnewname) {
            $json['erreur'] = false;
            $json['data_new_nom'] = $upnewname;
            $json['erreur_message'] = "";
        } else {
            $json['erreur_message'] = "erreur mis à jour $newname";
        }
    } else {
        $json['erreur_message'] = "name pas trouvé";
    }
    if (
        isset($_REQUEST['newprice'])
        and !empty($_REQUEST['newprice'])
        and $_REQUEST['newprice'] != $product['price']
    ) {
        $newprice    = htmlspecialchars($_REQUEST['newprice']);
        $newprice   = $bdd->prepare("UPDATE produits SET price = ? WHERE id_product = :id_product");
        $requser->bindValue(":id_product", $id_product, PDO::PARAM_INT);
        $upnewprice->execute(array($newprice, $_SESSION['id_produit']));
        if ($upnewprice) {
            $json['erreur'] = false;
            $json['data_new_price'] = $upnewprice;
            $json['erreur_message'] = "";
        } else {
            $json['erreur_message'] = "erreur mis à jour $newprice";
        }
    } else {
        $json['erreur_message'] = "price pas trouvé";
    }
    if (
        isset($_REQUEST['newref'])
        and !empty($_REQUEST['newref'])
        and $_REQUEST['newref'] != $product['ref']
    ) {
        $newref    = htmlspecialchars($_REQUEST['newref']);
        $newref   = $bdd->prepare("UPDATE produits SET ref = ? WHERE id_product = :id_product");
        $requser->bindValue(":id_product", $id_product, PDO::PARAM_INT);
        $upnewref->execute(array($newprice, $_SESSION['id_produit']));
        if ($upnewprice) {
            $json['erreur'] = false;
            $json['data_new_ref'] = $upnewref;
            $json['erreur_message'] = "";
        } else {
            $json['erreur_message'] = "erreur mis à jour $newref";
        }
    } else {
        $json['erreur_message'] = "ref pas trouvé";
    }
    if (
        isset($_REQUEST['newqty'])
        and !empty($_REQUEST['newqty'])
        and $_REQUEST['newqty'] != $product['qty']
    ) {
        $newqty    = htmlspecialchars($_REQUEST['newqty']);
        $newqty   = $bdd->prepare("UPDATE produits SET qty = ? WHERE id_product = :id_product");
        $requser->bindValue(":id_product", $id_product, PDO::PARAM_INT);
        $upnewqty->execute(array($newqty, $_SESSION['id_produit']));
        if ($upnewqty) {
            $json['erreur'] = false;
            $json['data_new_ref'] = $upnewqty;
            $json['erreur_message'] = "";
        } else {
            $json['erreur_message'] = "erreur mis à jour $newqty";
        }
    } else {
        $json['erreur_message'] = "qty pas trouvé";
    }
    echo json_encode($json);
} else {
    die("erreur not get id_product");
}