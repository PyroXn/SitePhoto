<?php

class Image {
    
    private $url;
    private $titre;
    private $description;
    private $idMembre;
    private $idAlbum;
    
    /*   CONSTRUCTOR    */
    
    function __construct($url) {
        $this->url = $url;
    }
    
    /*    GETTER    */
    
    function getUrl() {
        return $this->url;
    }
    
    function getTitre() {
        return $this->titre;
    }
    
    function getDescription() {
        return $this->description;
    }
    
    function getIdMembre() {
        return $this->idMembre;
    }
    
    function getIdAlbum() {
        return $this->idAlbum;
    }
    function getHeight() {
        $height = getimagesize($this->url);
        return $height[1];
    }
    
    function getWidth() {
        $width = getimagesize($this->url);
        return $width[0];
    }
    
    function getType() {
        $type = getimagesize($this->url);
        return $type[2];
    }
    
    /*    SETTER    */
    
    function setUrl($url) {
        $this->url = $url;
    }
    
    function setTitre($titre) {
        $this->titre = $titre;
    }
    
    function setDescription($description) {
        $this->description = $description;
    }
    
    function setIdMembre($idMembre) {
        $this->idMembre = $idMembre;
    }
    
    function setIdAlbum($idAlbum) {
        $this->idAlbum = $idAlbum;
    }
    
    /*    METHODES    */
    

}
?>
