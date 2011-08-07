<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
    
    public function getExpediteur() {
        return $this->expediteur;
    }

    public function setExpediteur($expediteur) {
        $this->expediteur = $expediteur;
    }

    public function getDestinataire() {
        return $this->destinataire;
    }

    public function setDestinataire($destinataire) {
        $this->destinataire = $destinataire;
    }

    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
    
    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }
    
    /**
     * Permet de sécuriser le message
     */
    public function isSecurise() {
        if (get_magic_quotes_gpc()) {
            $this->message = stripslashes($this->message);
        }
        $this->message = mysql_real_escape_string($this->message);
    } 
}

?>
