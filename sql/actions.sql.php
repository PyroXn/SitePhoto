<?php

function getLastAction() {
    $tabActions = array();
    $sql = 'SELECT * FROM actions WHERE idMembre="'.$_SESSION['user']->getId().'" ORDER BY Id DESC LIMIT 10';
    $req = mysql_query($sql);
    while($data = mysql_fetch_assoc($req)) {
        $action = new Actions($data['id'], $data['idMembre'], $data['actions'], $data['timestamp']);
        $tabActions[] = $action;
    }
    return $tabActions;
}

function newAction($action,$idMembre) {
    $sql = 'INSERT INTO actions (idMembre, actions) VALUES ("'.$idMembre.'","'.$action.'")';
    $req = mysql_query($sql);
}
?>
