<?php
// On test la connexion � la base de donn�es
try {
    $DB = new PDO('mysql:host=localhost;dbname=tutos','root',' ');
}
catch (PDOException $e) {
    echo 'La base de donn�es n\'est pas disponible.';
}

// On construit notre requ�te
$sql = 'SELECT * FROM comments';
// On execute notre requ�te
$req = $DB->query($sql);
// Pour afficher les r�sultats
while($d = $req->fetch()) {
    echo '<pre>';
    print_r($d);
    echo '</pre>';
}

?>
