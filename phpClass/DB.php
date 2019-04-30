<?php

class DB {

    private $pdo; // variable d'instance pdo

    // database constructor
    public function __construct($name, $login = "root", $password = "root", $host = "localhost") {
            $this->$pdo =  new PDO("mysql:host=$host;dbname=$name;charset=utf8", $login, $password);
            // source: https://www.php.net/manual/fr/pdo.setattribute.php
            $this->$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // permet d'afficher les erreur de PDO au lieu de les passer sous silence
            $this->$pdo->setAttribute(ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // retourne les fetch sous forme d'objet plutôt qu'un tableau sur les nom et index
        }
    }

    public function requete($SQL, $variables = false) {

        if( $variables ) {
            $req = $this->$db->prepare($SQL);
            $req->execute($variables);
        }else{
            $req = $this->$db->query($SQL);
        }
        return $req;
    }

    public function getLastInsertId(){
        return $this->$db->last
    }
}

?>