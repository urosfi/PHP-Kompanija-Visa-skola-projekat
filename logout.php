<?php
session_start();

unset($_SESSION["userid"]);
unset($_SESSION["usersuid"]);
header("Location:/projekat/forma.php");

?>