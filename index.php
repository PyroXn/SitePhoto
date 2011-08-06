<?php
if(!isset($_GET['p'])) { $_GET['p'] = "home"; }
elseif ($_GET['p'] == "inscription") { include('#'); inscription(); }

?>
