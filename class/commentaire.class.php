<?php

class Commentaire {

    private $id; 
    private $idMembre;
    private $message;
    private $timestamp;
    private $idPhoto;

    /*   CONSTRUCTOR    */

    function __construct($idMembre=null, $message=null, $timestamp=null, $idPhoto=null) {
        $this->idMembre = $idMembre;
        $this->message = stripcslashes(strip_tags(mysql_real_escape_string ($message)));
        $this->timestamp = $timestamp;
        $this->idPhoto = $idPhoto;
    }

    /*   GETTER    */

    function getId() {
        return $this->id;
    }
    
    function getIdMembre() {
        return $this->idMembre;
    }

    function getMessage() {
        return $this->message;
    }

    function getTimeStamp() {
        return $this->timestamp;
    }

    function getTimeStampFormat() {
        $date = strtotime($this->timestamp);
        $now = time();
        $result = $now - $date;
        if($result < 60) {
            return $result.' secondes';
        }
        elseif($result > 60 && $result < 3600) {
            $min = round($result / 60,0);
            return $min.' minutes';
        }
        elseif($result > 3600 && $result < 86400) {
            $heure = round($result / (60*60),0);
            return $heure.' heures';
        }
        elseif($result > 86400 && $result < 2678400) {
            $jours = round($result / (60*60*24));
            return $jours.' jours';
        }
        elseif($result > 2678400) {
            $mois = round($result / (60*60*24*31));
            return $mois.' mois';
        }
    }
    
    function getIdPhoto() {
        return $this->idPhoto;
    }

    /*   SETTER    */

    function setId($id) {
        $this->id = $id;
    }
    
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

}

?>
