<?php

/**
 * Verifie que le pseudo n'est pas utilisé
 * @return booléen Retourne true si le pseudo existe
 */
function isPseudoExist(Membre $membre) {
    $sql = "SELECT pseudo FROM membres WHERE pseudo = '" . $membre->getPseudo() . "'";
    $req = mysql_query($sql);
    return mysql_num_rows($req) != 0 ? true : false;
}

/**
 * Verifie que le mail n'est pas utilisé
 * @return booléen Retourne true si le mail existe
 */
function isMailExist(Membre $membre) {
    $sql = "SELECT mail FROM membres WHERE mail = '" . $membre->getMail() . "'";
    $req = mysql_query($sql);
    return mysql_num_rows($req) != 0 ? true : false;
}

/**
 * Permet de tester les identifiants lors du log
 * Securite : stripslashes, mysql_real_escape_string
 * @return Booléen Retourne vrai si l'utilisateur existe. 
 */
function isExist(Membre $membre) {
    $sql = "SELECT mail,password FROM membres WHERE mail='" . $membre->getMail() . "' AND password='" . $membre->getPassword() . "'";
    $req = mysql_query($sql);
    return mysql_num_rows($req) != 0 ? true : false;
}

/**
 * Login : Charge les données de l'utilisateur si utilisateur confirmé 
 * @param Membre Objet membre
 */
function getMembre(Membre $membre) {
    $sql = "SELECT * FROM membres WHERE mail='" . $membre->getMail() . "' AND password='" . $membre->getPassword() . "'";
    $req = mysql_query($sql);
    $data = mysql_fetch_assoc($req);
    $membre->setPseudo($data['pseudo']);
    $membre->setSexe($data['sexe']);
    $membre->setBirthday($data['birthday']);
    $membre->setAvatar($data['avatar']);
    $membre->setCle($data['cle']);
    $membre->setId($data['id']);
    $membre->setLastVisit($data['lastVisit']);
    return $membre;
}

/**
 * Permet d'insérer un nouveau membre si controle ok
 */
function register(Membre $membre) {
    $sql = "INSERT INTO membres(mail,password,pseudo,sexe,birthday,avatar,cle) VALUES ('" . $membre->getMail() . "','" . $membre->getPassword() . "','" . $membre->getPseudo() . "','" . $membre->getSexe() . "','" . $membre->getBirthday() . "','" . $membre->getAvatar() . "','" . $membre->getCle() . "')";
    $req = mysql_query($sql);
}

/**
 * Permet de modifier l'users
 */
function update(Membre $membre) {
    $sql = "UPDATE membres SET mail='" . $membre->getMail() . "', password='" . $membre->getPassword() . "', pseudo='" . $membre->getPseudo() . "',sexe='" . $membre->getSexe() . "', avatar='" . $membre->getAvatar() . "'";
    $req = mysql_query($sql);
}

/**
 *
 * @param int $id id du membre à charger
 * @return Membre Retourne objet membre
 */
function loadMembre($id) {
    $sql = "SELECT * FROM membres WHERE id=$id";
    $req = mysql_query($sql) or die("Erreur : loadMembre");
    $data = mysql_fetch_array($req) or die("Erreur : loadMembre N°2");
    $membre = new Membre($data['mail'],null);
    $membre->setPseudo($data['pseudo']);
    $membre->setAvatar($data['avatar']);
    $membre->setBirthday($data['birthday']);
    $membre->setCle($data['cle']);
    $membre->setId($data['id']);
    $membre->setLastVisit($data['lastVisit']);
    $membre->setSexe($data['sexe']);
    return $membre;
}

/**
 * Permet d'update le timestamp du membre
 */
function updateLastVisit() {
    $sql = 'UPDATE membres SET lastVisit=NOW() WHERE id="'.$_SESSION['user']->getId().'"';
    $req = mysql_query($sql);
}

?>
