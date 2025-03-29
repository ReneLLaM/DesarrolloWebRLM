<?php 
$con = mysqli_connect("localhost", "root", "", "bd_banco");
if(mysqli_connect_errno()){
    die("Se produjo un error ".mysqli_connect_error());
}
?>