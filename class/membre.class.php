<?php


class Membre {

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

}
?>
