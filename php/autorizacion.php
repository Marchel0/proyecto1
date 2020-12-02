<?php
session_start();
if(!isset($_SESSION["rut"])){
header("Location: login.php");
exit(); }
?>
