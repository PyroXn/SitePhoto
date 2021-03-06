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
    private $lastVisit;
    private $admin;

    /*   CONSTRUCTOR    */

    /**
     * Inscription : Création de l'objet avec mail et password
     * @param String $mail
     * @param Password $password
     */
    function __construct($mail, $password) {
        $this->mail = strip_tags(mysql_real_escape_string($mail));
        $this->password = md5(strip_tags(mysql_real_escape_string($password)));
    }

    /*   GETTER    */

    function getId() {
        return $this->id;
    }

    function getPseudo() {
        return stripcslashes($this->pseudo);
    }
    
    function getPseudoFormat() {
        if($this->sexe == 1) {
            return '<img src=\"thumb.php?src='.$this->getAvatar().'&x=30&y=30&f=0\"></img><a class=\"pseudo_homme\" href=\"index.php?p=profil&id='.$this->getId().'\">'.$this->getPseudo().'</a>';
        } else {
            return '<img src=\"thumb.php?src='.$this->getAvatar().'&x=30&y=30&f=0\"></img><a class=\"pseudo_femme\" href=\"index.php?p=profil&id='.$this->getId().'\">'.$this->getPseudo().'</a>';
        }
    }
    
    function getPseudoAction() {
        if($this->pseudo == $_SESSION['user']->getPseudo()) {
            return 'Vous';
        } else {
            return $this->getPseudoFormat();
        }
    }
    
    function getPassword() {
        return $this->password;
    }

    function getMail() {
        return $this->mail;
    }

    function getSexe() {
        return $this->sexe;
    }
    
    function getSexeFormat() {
        if ($this->sexe == 1) {
            return "Homme";
        } else {
            return "Femme";
        }
    }

    function getAvatar() {
        return $this->avatar;
    }

    function getBirthday() {
        return $this->birthday;
    }
    
    function getBirthdayFormat() {
        return date("d/m/Y", strtotime($this->birthday));
    }
    
    function getCle() {
        return $this->cle;
    }

    function getLastVisit() {
        return date("d/m/Y", strtotime($this->lastVisit));
    }

    function getAdmin() {
        return $this->admin;
    }
    
    /*   SETTER    */

    function setPseudo($pseudo) {
        $this->pseudo = strip_tags(mysql_real_escape_string($pseudo));
    }

    /**
     * Permet hasher le password via MD5
     * @param String $password Mot de passe en clair
     */
    function setPassword($password) {
        $this->password = md5(strip_tags(mysql_real_escape_string($password)));
    }

    function setMail($mail) {
        $this->mail = strip_tags(mysql_real_escape_string($mail));
    }

    function setSexe($sexe) {
        $this->sexe = strip_tags(mysql_real_escape_string($sexe));
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

    function setLastVisit($timestamp) {
        $this->lastVisit = $timestamp;
    }
    
    function setAdmin($admin) {
        $this->admin = $admin;
    }
    
    /*   METHODES    */
}

?>
