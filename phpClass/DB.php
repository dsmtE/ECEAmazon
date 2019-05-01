<?php

class DB {

    private $pdo; // variable d'instance pdo

    // database constructor
    public function __construct($name, $login = "root", $password = "", $host = "localhost") {
        $this->pdo =  new PDO("mysql:host=$host;dbname=$name;charset=utf8", $login, $password);
        // source: https://www.php.net/manual/fr/pdo.setattribute.php
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // permet d'afficher les erreur de PDO au lieu de les passer sous silence
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); // retourne les fetch sous forme d'objet plutôt qu'un tableau sur les nom et index
    }

    public function requete($SQL, $variables = false) {// permet de faire une requete à la base de donné

        if( $variables ) {
            $req = $this->pdo->prepare($SQL);
            $req->execute($variables);
        }else{
            $req = $this->pdo->query($SQL);
        }
        return $req;
    }

    public function getLastInsertId() { // recupere l'id du dernier element de la boase de donné 
        return $this->pdo->lastInsertId();
    }

    public function getUser($idUser) { // requête prédéfini souvent utilisée
        return $this->requete('SELECT * FROM Utilisateurs WHERE idUser = ?', [$idUser])->fetch();
    }
}

?>