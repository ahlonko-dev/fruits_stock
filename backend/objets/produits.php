<?php
class Produits
{

    // Connexion Base de donnee et le nom de la  table
    private $table_name = "produits";

    // Proprietes des objets
    public $id_product;
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


    // Suprimer le produit
    function delete()
    {

        // sql query pour suprimer
        $query = "DELETE FROM " . $this->table_name . " WHERE id_product = ?";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // Proteger l'id et recuperer
        $this->id_product = htmlspecialchars(strip_tags($this->id_product));

        // lier l'id de l'enregistrement à supprimer
        $stmt->bindParam(1, $this->id_product);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
