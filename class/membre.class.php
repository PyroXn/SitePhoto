<?php
/*
 * TODO : Créer un premier jet de la table membres
 */
class membre {
    private $pseudo;
    private $password;
    private $mail;
    private $sexe;
    private $avatar; // Uniquement l'url de l'avatar
    private $birthday;
    
/*   CONSTRUCTOR    */  
    
    /**
     * Inscription : Création de l'objet avec mail et password
     * @param String $mail
     * @param Password $password
     */
    function __construct($mail, $password) {
        $this->mail = $mail;
        $this->password = $password;
    }
    
/*   GETTER    */
    
    function getPseudo() {
        return $this->pseudo;
    }
    function getPassword() {
        return $this->password;
    }
    function getMail() {
        return $this>mail;
    }
    function getSexe() {
        return $this->sexe;
    }
    function getAvatar() {
        return $this->avatar;
    }
    function getBirthday() {
        return $this->birthday;
    }
    
/*   SETTER    */ 
    
    function setPseudo($pseudo) {
        $this->pseudo = $pseudo;
    }
    
    /**
     * Permet hasher le password via MD5
     * @param String $password Mot de passe en clair
     */
    function setPassword($password) {
        $this->password = md5($password);
    }
    function setMail($mail) {
        $this->mail = $mail;
    }
    function setSexe($sexe) {
        $this->sexe = $sexe;
    }
    function setAvatar($url) {
        $this->avatar = $url;
    }
    function setBirthday($birthday) {
        $this->birthday = $birthday;
    }
    
/*   METHODES    */
    
    /**
     * Verifie que le pseudo n'est pas utilisé
     * @return booléen Retourne true si le pseudo existe
     */
    function ifPseudoExist() {
        if (get_magic_quotes_gpc()) {
            $this->pseudo = stripslashes($this->pseudo);
        }
        $this->pseudo = mysql_real_escape_string($this->pseudo);
        $sql = "SELECT pseudo FROM membres WHERE pseudo = '".$this->pseudo."'";
        $req = mysql_query($sql);
        if (mysql_num_rows($req) != 0) { return true; }
        else { return false; }
    }
    
    /**
     * Verifie que le mail n'est pas utilisé
     * @return booléen Retourne true si le mail existe
     */
    function ifMailExist() {
        if (get_magic_quotes_gpc()) {
            $this->mail = stripslashes($this->mail);
        }
        $this->mail = mysql_real_escape_string($this->mail);
        $sql = "SELECT mail FROM membres WHERE mail = '".$this->mail."'";
        $req = mysql_query($sql);
        if (mysql_num_rows($req) != 0) { return true; }
        else { return false; }
    }
        
    /**
     * Permet de tester les identifiants lors du log
     * Securite : stripslashes, mysql_real_escape_string
     * @return Booléen Retourne vrai si l'utilisateur existe. 
     */
    function ifExist() {
        if (get_magic_quotes_gpc()) {
            $this->mail = stripslashes($this->mail);
        }
        $this->mail = mysql_real_escape_string($this->mail);
        $this->password = md5($this->password);
        $sql = "SELECT mail,password FROM membres WHERE mail='".$this->mail."' AND password='".$this->password."'";
        $req = mysql_query($sql);
        if (mysql_num_rows($req) != 0) { return true; }
        else { return false; }
    }
    
    /**
     * Charge les données de l'utilisateur si utilisateur confirmé 
     */
    function isCo() {
        $sql = "SELECT * FROM membres WHERE mail='".$this->mail."' AND password='".$this->password."'";
        $req = mysql_query($sql);
        $data = mysql_fetch_assoc($req);
        $this->pseudo = $data['pseudo'];
        $this->sexe = $data['sexe'];
        $this->birthday = $data['birthday'];
        $this->avatar = $data['avatar'];
    }
    
    /**
     * Permet d'insérer un nouveau membre si controle ok
     */
    function isRegister() {
        $sql = "INSERT INTO membres(mail,password,pseudo,sexe,birthday,avatar) VALUES ('".$this->mail."','".$this->password."','".$this->pseudo."','".$this->sexe."','".$this->birthday."','".$this->avatar."')";
        $req = mysql_query($sql);
    }  
    
}
?>
