<?php
require "./libs/data_base.php";
header('Content-Type: application/json');
$json = [
    "erreur"         => true, /* indique si il y a une erreur ou non */
    "erreur_message" => "en attente de connexion frontent", /* il indique le message d'erreur pour les front */
    "reponse_formulaire"       => "" /* il sert à afficher se qu'on envoie aux front - les données de réponses */
];

if (
    isset($_REQUEST['name']) and isset($_REQUEST['ref'])  and isset($_REQUEST['price'])
    and isset($_REQUEST['qty'])
    and !empty($_REQUEST['name']) and !empty($_REQUEST['ref']) and !empty($_REQUEST['price'])
    and !empty($_REQUEST['qty'])
) {

    $name = htmlspecialchars($_REQUEST['name']);
    $ref = htmlspecialchars($_REQUEST['ref']);
    $qty = htmlspecialchars($_REQUEST['qty']);
    $price = htmlspecialchars($_REQUEST['price']);
    // $id_fournisseur = htmlspecialchars($_REQUEST['id_fournisseur']);

    try {
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete = $bdd->prepare('INSERT INTO produits (name, ref, price, qty)
        VALUES (?, ?, ?, ?)');
        $res =  $requete->execute(array(
            $name, $ref, $price, $qty
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
    $json['erreur_message'] = 'veuillez remplir tous les champs!';
}
echo json_encode($json);
die;