<?php


class Membre {

    private $id;
    private $pseudo;
    private $password;
    private $mail;
    private $sexe;
    private $avatar; // Uniquement l'url de l'avatar
    private $birthday;
    private $cle;

    /*   CONSTRUCTOR    */

    /**
     * Inscription : Création de l'objet avec mail et password
     * @param String $mail
     * @param Password $password
     */
    function __construct($mail, $password) {
        $this->mail = strip_tags(mysql_real_escape_string ($mail));
        $this->password = md5(strip_tags(mysql_real_escape_string ($password)));
    }

    /*   GETTER    */
    
    function getId() {
        return $this->id;
    }
    
    function getPseudo() {
        return $this->pseudo;
    }

    function getPassword() {
        return $this->password;
    }

    function getMail() {
        return $this-> mail;
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
    
    function getCle() {
        return $this->cle;
    }

    /*   SETTER    */

    function setPseudo($pseudo) {
        $this->pseudo = strip_tags(mysql_real_escape_string ($pseudo));
    }

    /**
     * Permet hasher le password via MD5
     * @param String $password Mot de passe en clair
     */
    function setPassword($password) {
        $this->password = md5(strip_tags(mysql_real_escape_string ($password)));
    }

    function setMail($mail) {
        $this->mail = strip_tags(mysql_real_escape_string ($mail));
    }

    function setSexe($sexe) {
        $this->sexe = strip_tags(mysql_real_escape_string ($sexe));
    }

    function setAvatar($url) {
        $this->avatar = $url;
    }

    function setBirthday($birthday) {
        $this->birthday = $birthday;
    }
    
    function setCle($cle) {
        $this->cle = $cle;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    /*   METHODES    */

}
?>
