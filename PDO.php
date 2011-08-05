<?php
// On test la connexion à la base de données
try {
    $DB = new PDO('mysql:host=localhost;dbname=tutos','root',' ');
}
catch (PDOException $e) {
    echo 'La base de données n\'est pas disponible.';
}

// On construit notre requète
$sql = 'SELECT * FROM comments';
// On execute notre requète
$req = $DB->query($sql);
// Pour afficher les résultats
while($d = $req->fetch()) {
    echo '<pre>';
    print_r($d);
    echo '</pre>';
}

?>
