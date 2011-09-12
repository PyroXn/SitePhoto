<?php
class Concours {
    private $id;
    private $titre;
    private $description;
    private $nbParticipant;
    
    function __construct($titre,$description) {
        $this->titre = strip_tags(mysql_real_escape_string ($titre));
        $this->description = strip_tags(mysql_real_escape_string ($description));
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getTitre() {
        return $this->titre;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getNbParticipant() {
        return $this->nbParticipant;
    }

    function setNbParticipant($nbParticipant) {
        $this->nbParticipant = $nbParticipant;
    }


    
}
?>
