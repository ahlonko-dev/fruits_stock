 <?php
    define('DEBUG', true); //  true je suis en local

    if (!DEBUG) {
        error_reporting(0);
        // echo "connecté à la bd Avec DEBUG";
    }

    $dbname   = "fruits_stock";
    $host     = "localhost";
    $charset  = "utf8";
    $dbuser   = "root";
    $dbpwd    = "";

    try {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $dbuser, $dbpwd);
    } catch (Exception $erreur) {
        if (DEBUG) {
            die("Erreur de connexion à la base de données" . $erreur->getMessage());
        } else {
            die("Erreur de connexion à la base de données, merci de contacter XXX");
        }
    }