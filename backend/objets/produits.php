<?php
class Product
{

    // Connexion Base de donnee et le nom de la  table
    private $conn;
    private $table_name = "produits";

    // Proprietes des objets
    public $id_produit;
    public $nom;
    public $ref;
    public $qte;
    public $prix;

    // public $created;

    // constructeur avec la base de donnee (connexion)
    public function __construct($db)
    {
        $this->conn = $db;
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
}
