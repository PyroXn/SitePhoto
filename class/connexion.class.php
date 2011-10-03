<?php

class Connexion {
    
    function __construct() {
        mysql_connect("localhost", "root", "");
        mysql_select_db("SitePhoto");
        mysql_query("SET NAMES UTF8");
    }
}
?>
