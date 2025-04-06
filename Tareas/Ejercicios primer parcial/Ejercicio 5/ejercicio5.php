<?php 
$numero = $_GET['numero'];

if($numero % 2 == 0){
    echo "el numero ". $numero ." es par";
}else{
    echo "el numero ". $numero ." es impar";
}
?>