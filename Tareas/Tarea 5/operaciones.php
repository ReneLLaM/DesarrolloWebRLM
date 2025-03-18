<?php
session_start();

include("pila.php"); 


if(isset($_SESSION['op'])) { 
    $op = $_SESSION['op'];
}


if(isset($_SESSION['pila'])) {
    $pila = unserialize($_SESSION['pila']);
} else {
    $pila = new Pila();
}

switch($op) {
    case "insertar":
        if(isset($_POST['elemento'])) {
            $pila->insertar($_POST['elemento']);
        }
        //redireccionar
        header("Location: opciones.php");
        break;
    case "eliminar":
        $elementoEliminado = $pila->eliminar();
        if($elementoEliminado !== null) {
            echo "Elemento eliminado: " . $elementoEliminado . "<br>";
        } else {
            echo "No hay elementos para eliminar<br>";
        }
        echo '<a href="opciones.php">Opciones</a>';
        break;
    case "mostrar":
        echo "Elementos de la pila: <br>";
        $pila->mostrar();
        echo '<a href="opciones.php">Opciones</a>';
        break;
    case "salir":
        session_destroy();
        exit;
        break;
}

$_SESSION['pila'] = serialize($pila);
?>