<?php

// Fichier regroupant les pages inscription, connexion, oublie mot de passe...

function inscription() {
$title = "Devenez photographe !";
$content .= "<h2>Inscrivez vous - Partagez vos galleries !</h2>";
$content .= "<hr class='hrTitle'></hr>";
$content .= "<form method='post' action='index.php?p='>";
$content .= "<table border='0'>";
$content .= "<tr>
                    <td>E-mail </td>
                    <td><input type='text' name='mail'></td>
                 </tr>
                 <tr>
                    <td>Confirmer e-mail </td>
                    <td><input type='text' name='mail2'></td>
                 </tr>
                 <tr>
                    <td>Mot de passe </td>
                    <td><input type='password' name='password'>'</td>
                 </tr>
                 <tr>
                    <td>Je suis </td>
                    <td><select name='sexe' size='1'>
                        <option value='2'>Femme</option>
                        <option value='1'>Homme</option>
                        </select></td>
                 </tr>
                 <tr>
                    <td>Date de naissance</td>
                    <td><select name='birthday'>
                        <option value=''>Jour</option>";
for ($i = 1; $i<=31; $i++) {
$content .= "<option value=$i>$i";
}

$content .= "</select>";
$content .= "<select name='birthmonth'>
             <option value=''>Mois</option>";
for ($i = 1; $i<=12; $i++) {
$content .= "<option value=$i>$i";
}
$content .= "</select>";
$content .= "<select name='birthyear'>
             <option value=''>Année</option>";
for ($i = 1900; $i<=Date("Y"); $i++) {
$content .= "<option value=$i>$i";
}
$content .= "</select>";
$content .= "</td><tr>";
$content .= "<tr>
                <td>Pseudo</td>
                <td><input type='text' name='pseudo'></td>";
$content .= "</tr>";
$content .= "<tr>
                <td></td>
                <td><input type='submit' value='Inscription'></td>";
$content .= "</tr>";
$content .= "</table>";
display($title,$content);
    
}
?>
