<?php
class Produits
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
