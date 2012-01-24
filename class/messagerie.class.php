<?php

/**
 * Description of messagerie
 *
 * @author MyDevHouse
 */

class Messagerie {
    
    private $id;
    private $expediteur;
    private $destinataire;
    private $sujet;
    private $message;
    private $timestamp;
    private $etat;
    
    function __construct($id=null,$expediteur=null, $destinataire=null, $sujet=null, $message=null, $timestamp=null, $etat=null) {
        $this->id = $id;
        $this->expediteur = $expediteur;
        $this->destinataire = $destinataire;
        $this->sujet = $sujet;
        $this->message = $message;
        $this->timestamp = $timestamp;
        $this->etat = $etat;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
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

    public function getEtat() {
        return $this->etat;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function getLittleMessage() {
        return substr($this->message, 10);
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
