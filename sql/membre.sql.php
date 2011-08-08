<?php

/**
 * Verifie que le pseudo n'est pas utilisé
 * @return booléen Retourne true si le pseudo existe
 */
function isPseudoExist(Membre $membre) {
    if (get_magic_quotes_gpc()) {
        $membre->setPseudo(stripslashes($membre->getPseudo()));
    }
    $membre->setPseudo(mysql_real_escape_string($membre->getPseudo()));
    $sql = "SELECT pseudo FROM membres WHERE pseudo = '" . $membre->getPseudo() . "'";
    $req = mysql_query($sql);
    return mysql_num_rows($req) != 0 ? true : false;
}

/**
 * Verifie que le mail n'est pas utilisé
 * @return booléen Retourne true si le mail existe
 */
function isMailExist(Membre $membre) {
    if (get_magic_quotes_gpc()) {
        $membre->setMail(stripslashes($membre->getMail()));
    }
    $membre->setMail(mysql_real_escape_string($membre->getMail()));
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
    if (get_magic_quotes_gpc()) {
        $membre->setMail(stripslashes($membre->getMail()));
    }
    $membre->setMail(mysql_real_escape_string($membre->getMail()));
    $membre->setPassword($membre->getPassword());
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
    return $membre;
}

/**
 * Permet d'insérer un nouveau membre si controle ok
 */
function Register(Membre $membre) {
    $sql = "INSERT INTO membres(mail,password,pseudo,sexe,birthday,avatar) VALUES ('" . $membre->getMail() . "','" . $membre->getPassword() . "','" . $membre->getPseudo() . "','" . $membre->getSexe() . "','" . $membre->getBirthday() . "','" . $membre->getAvatar() . "')";
    $req = mysql_query($sql);
}

/**
 * Permet de modifier l'users
 */
function Update(Membre $membre) {
    $sql = "UPDATE membres SET mail='" . $membre->getMail() . "', password='" . $membre->getPassword() . "', pseudo='" . $membre->getPseudo() . "',sexe='" . $membre->getSexe() . "', avatar='" . $membre->getAvatar() . "'";
    $req = mysql_query($sql);
}
?>
