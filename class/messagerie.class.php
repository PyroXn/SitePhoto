<?php

/**
 * Description of messagerie
 *
 * @author MyDevHouse
 */

class Messagerie {
    
    private $expediteur;
    private $destinataire;
    private $sujet;
    private $message;
    private $timestamp;
    
    function __construct($expediteur, $destinataire, $sujet, $message, $timestamp) {
        $this->expediteur = $expediteur;
        $this->destinataire = $destinataire;
        $this->sujet = $sujet;
        $this->message = $message;
        $this->timestamp = $timestamp;
    }
    
    function getExpediteur() {
        return $this->expediteur;
    }

    function setExpediteur($expediteur) {
        $this->expediteur = $expediteur;
    }

    function getDestinataire() {
        return $this->destinataire;
    }

    function setDestinataire($destinataire) {
        $this->destinataire = $destinataire;
    }

    function getSujet() {
        return $this->sujet;
    }

    function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    function getMessage() {
        return $this->message;
    }

    function setMessage($message) {
        $this->message = $message;
    }
    
    function getTimestamp() {
        return $this->timestamp;
    }

    function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
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
