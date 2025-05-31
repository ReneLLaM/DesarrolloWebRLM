<?php session_start();
include("conexion.php");
include("verificar.php");

$nivel = $_GET['nivel'];

$id = $_GET['id'];

if($nivel == 0){
    $nivel = 1;
}else{
    $nivel = 0;
}

$sql = $con->prepare("UPDATE usuarios SET nivel = ? WHERE id = ? and usuario != 'admin'");
$sql->bind_param("ii", $nivel, $id);


$sql->execute();

echo $nivel;

?>