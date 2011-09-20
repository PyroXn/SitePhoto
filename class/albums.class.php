<?php
class Album {
    
    private $id;
    private $titre;
    private $idMembres;
    
    function __construct($id = null,$titre = null,$idMembres = null) {
        $this->id = $id;
        $this->titre = strip_tags(mysql_real_escape_string ($titre));
        $this->idMembres = $idMembres;      
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function setTitre($titre) {
        $this->titre = $titre;
    }

    public function getIdMembres() {
        return $this->idMembres;
    }

    public function setIdMembres($idMembres) {
        $this->idMembres = $idMembres;
    }


}
