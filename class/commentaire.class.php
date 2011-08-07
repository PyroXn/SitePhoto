<?php

class Commentaire {

    private $idMembre;
    private $message;
    private $timestamp;
    private $idPhoto;

    /*   CONSTRUCTOR    */

    function __construct($idMembre, $message, $timestamp, $idPhoto) {
        $this->idMembre = $idMembre;
        $this->message = $message;
        $this->timestamp = $timestamp;
        $this->idPhoto = $idPhoto;
    }

    /*   GETTER    */

    function getIdMembre() {
        return $this->idMembre;
    }

    function getMessage() {
        return $this->message;
    }

    function getTimeStamp() {
        return $this->timestamp;
    }

    function getIdPhoto() {
        return $this->idPhoto;
    }

    /*   SETTER    */

    function setIdMembre($idMembre) {
        $this->idMembre = $idMembre;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    function setIdPhoto($idPhoto) {
        $this->idPhoto = $idPhoto;
    }

    /*   METHODES    */

    /**
     * Permet de sécuriser le message
     */
    function isSecurise() {
        if (get_magic_quotes_gpc()) {
            $this->message = stripslashes($this->message);
        }
        $this->message = mysql_real_escape_string($this->message);
    }

    /**
     * Permet d'insérer un nouveau commentaire
     */
    function isSubmit() {
        $sql = "INSERT INTO commentaires(idMembre,message,timestamp,idPhoto) VALUES ('" . $this->idMembre . "','" . $this->message . "','" . $this->timestamp . "','" . $this->idPhoto . "')";
        $req = mysql_query($sql);
    }

}

?>
