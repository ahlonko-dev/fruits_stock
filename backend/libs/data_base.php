 <?php
    define('DEBUG', true); //  true je suis en local

    if (!DEBUG) {
        error_reporting(0);
        // echo "connecté à la bd Avec DEBUG";
    }
