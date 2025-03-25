<?php 
$numero = $_POST["numero"];
if($numero < 0){
    echo "El nunero no es entero <br>";
    echo '<a href="calcular.html">volver</a>';
    
}

$suma = 0;
while($numero > 0){
    $suma = $suma + $numero % 10;
    $numero = intval($numero) / 10;
}

echo "La suma de los digitos es: $suma";
?>
