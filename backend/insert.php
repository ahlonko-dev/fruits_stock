<?php
require "./libs/data_base.php";
header('Content-Type: application/json');
$json = [
    "erreur"         => true, /* indique si il y a une erreur ou non */
    "erreur_message" => "Uknown error", /* il indique le message d'erreur pour les front */
    "data"          => "" /* il sert à afficher se qu'on envoie aux front - les données de réponses */
];

if (
    isset($_REQUEST['nom']) and isset($_REQUEST['ref'])  and isset($_REQUEST['prix'])
    and isset($_REQUEST['qte'])  and isset($_REQUEST['fournisseur'])
    and !empty($_REQUEST['nom']) and !empty($_REQUEST['ref']) and !empty($_REQUEST['prix'])
    and !empty($_REQUEST['qte'])  and !empty($_REQUEST['fournisseur'])
) {

    $nom = htmlspecialchars($_REQUEST['nom']);
    $ref = $_REQUEST['ref'];
    $prix = $_REQUEST['prix'];
    $qte = $_REQUEST['qte'];
    $fournisseur = $_REQUEST['fournisseur'];

    try {
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $requete = $bdd->prepare('INSERT INTO produits (nom, ref, prix, qte, fournisseur)
        VALUES (?, ?, ?, ?, ?)');
        $res =  $requete->execute(array(
            $nom, $ref, $prix, $qte, $fournisseur
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