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

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->name = $row['name'];
        $this->ref = $row['ref'];
        $this->qty = $row['qty'];
        $this->price = $row['price'];
        $this->id_four = $row['id_fournisseur'];
        $this->name_four = $row['name_fournisseur'];
    }
}
