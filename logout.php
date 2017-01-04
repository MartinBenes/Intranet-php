<?php


session_start();
// zničí daný session
session_destroy();
// přesměruje zpět na stránku s loginem
header('location: login.php');
?>