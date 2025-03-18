<?php session_start();
echo "el valor del contador es " . $_SESSION["contador"] . "<br>";
session_destroy();
?>