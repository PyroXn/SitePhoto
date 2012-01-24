<?php

class Connexion {
    
    function __construct() {
        mysql_connect("localhost", "root", "root");
        mysql_select_db("sitephoto");
        mysql_query("SET NAMES UTF8");
    }
}
?>
