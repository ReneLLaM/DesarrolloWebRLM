<?php

include("operaciones.php");

$a = $_GET["a"];
$b = $_GET["b"];
$c = $_GET["c"];

$operaciones = new Operaciones($a, $b, $c);

switch($_GET["op"]){
    case "sumar":
        echo $operaciones->sumar();
        break;
    case "restar":
        echo $operaciones->restar();
        break;
    case "multiplicar":
        echo $operaciones->multiplicar();
        break;
    case "dividir":
        echo $operaciones->dividir();
        break;
}

?>