<?php

class commentaire {
    private $pseudo;
    private $message;
    private $timestamp;
    private $idPhoto;
    
/*   CONSTRUCTOR    */
    
    function __construct($pseudo,$message,$timestamp,$idPhoto) {
        $this->pseudo = $pseudo;
        $this->message = $message;
        $this->timestamp = $timestamp;
        $this->idPhoto = $idPhoto;
    }
    
/*   GETTER    */
    
    function getPseudo() {
        return $this->pseudo;
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
    
    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
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
        $sql = "INSERT INTO commentaires(pseudo,message,timestamp,idPhoto) VALUES ('".$this->pseudo."','".$this->message."','".$this->timestamp."','".$this->idPhoto."')";
        $req = mysql_query($sql);
    }
    
}
?>
