<?php
//header("Location: php/login.php"); die();
//include_once ("controller/login.php"); // must modify this one

require_once "controller/MainController.php";
$controller = new MainController();
$controller->route();

?>


<!--
    ADD::       a file with all the translations so the language can be changed easily
    MODIFY::    all the call to the various files
                    https://stackoverflow.com/questions/812571/how-to-create-friendly-url-in-php#
-->
