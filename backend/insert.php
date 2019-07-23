<?php
require "./libs/data_base.php";
header('Content-Type: application/json');
$json = [
    "erreur"         => true, /* indique si il y a une erreur ou non */
    "erreur_message" => "Uknown error", /* il indique le message d'erreur pour les front */
    "data"          => "" /* il sert à afficher se qu'on envoie aux front - les données de réponses */
];

if (
    isset($_REQUEST['name']) and isset($_REQUEST['ref'])  and isset($_REQUEST['price'])
    and isset($_REQUEST['qty'])  and isset($_REQUEST['id_fournisseur'])
    and !empty($_REQUEST['name']) and !empty($_REQUEST['ref']) and !empty($_REQUEST['price'])
    and !empty($_REQUEST['qty'])  and !empty($_REQUEST['id_fournisseur'])
) {

    $name = htmlspecialchars($_REQUEST['name']);
    $ref = $_REQUEST['ref'];
    $price = $_REQUEST['price'];
    $qty = $_REQUEST['qty'];
    $id_fournisseur = $_REQUEST['id_fournisseur'];

    try {
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete = $bdd->prepare('INSERT INTO produits (name, ref, price, qty, id_fournisseur)
        VALUES (?, ?, ?, ?, ?)');
        $res =  $requete->execute(array(
            $name, $ref, $price, $qty, $id_fournisseur
        ));
    } catch (Exception $e) {
        echo $e->getMessage();
    }


    $json['erreur'] = !$res;
    if ($res) {
        $json['reponse_formulaire'] = 'Votre formulaire a bien été envoyé!';
    } else {
        $json['erreur_message'] = "Erreur d'envoie formulaire";
    }
} else {
    $erreur_message = 'veuillez remplir tous les champs!';
}
echo json_encode($json);
die;