<?php
include "pila.php";
$pila = new Pila();
$pila->insertar(1);
$pila->insertar(2);
$pila->insertar(3);
echo "Elementos de la pila: <br>";
$pila->mostrar();
echo "Elemento eliminado: " . $pila->eliminar();

?>