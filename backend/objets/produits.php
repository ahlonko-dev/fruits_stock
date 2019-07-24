<?php
class Produits
{

    // Connexion Base de donnee et le nom de la  table
    private $table_name = "produits";

    // Proprietes des objets
    public $id_produit;
    public $name;
    public $ref;
    public $qty;
    public $price;

    public function __construct($bdd)
    {
        $this->conn = $bdd;
    }

    // Function lire les produits
    function read()
    {

        // requette sql (selectionner tout all)
        $query = "SELECT *
            FROM
                " . $this->table_name . "";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // used when filling up the update product form
    function readOne()
    {

        // query to read single record
        $query = "SELECT
                 *
             FROM
                 " . $this->table_name . " 
             WHERE
                 id_produit = ?
             LIMIT
                 0,1";
        /* requete a changer
        $query = "SELECT
                 c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
             FROM
                 " . $this->table_name . " p
                 LEFT JOIN
                     categories c
                         ON p.category_id = c.id
             WHERE
                 p.id = ?
             LIMIT
                 0,1";

                 */

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // lier l'id du produit à mettre à jour
        $stmt->bindParam(1, $this->id_produit);

        // execute query
        $stmt->execute();

        // Recuprer les ligne 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // définir des valeurs pour les propriétés d'objet
        $this->name = $row['name'];
        $this->ref = $row['ref'];
        $this->qty = $row['qty'];
        $this->price = $row['price'];
        // $this->id_four = $row['id_fournisseur'];
        // $this->name_four = $row['name_fournisseur'];
    }

    // Suprimer le produit
    function delete()
    {

        // sql query pour suprimer
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // Proteger l'id et recuperer
        $this->id = htmlspecialchars(strip_tags($this->id));

        // lier l'id de l'enregistrement à supprimer
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
