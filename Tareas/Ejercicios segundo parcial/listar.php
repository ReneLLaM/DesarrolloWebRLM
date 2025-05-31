<?php
session_start();
include("conexion.php");


if (!isset($_SESSION['usuario'])) { // si no existe la variable de sesion redirige a la pagina de login
    header("Location:formlogin.html");
}
if(!isset($_GET['boton'])){ // si existe el boton
    $id = $_SESSION['id'];

    $sql = "SELECT id, usuario as correo, nombrecompleto,nivel FROM usuarios WHERE nivel < 2 and id != '$id'";
    $resultado = $con->query($sql);


    ?>
    <a href="cerrar.php">Cerrar Sesion</a>
    <table>
        <thead>
            <tr>
                <th>Correos</th>
                <th>Nombre Completo</th>
                <th>Nivel</th>
                <?php if($_SESSION["nivel"] == 0) echo "<th>Operacion</th>"?>
            </tr>
        </thead>
        <tbody>

        <?php while($row=mysqli_fetch_array($resultado)){ ?>
            <tr>
                <td><?php echo $row["correo"]?></td>
                <td><?php echo $row["nombrecompleto"]?></td>
                <td><?php echo $row["nivel"] == 0 ? "Administrador" : "Usuario"?></td>
                <?php if($_SESSION["nivel"] == 0) echo "<td>".( $row["nivel"] == 0 ? "<a href='javascript:cambiarNivel(".$row['id'].",".$row['nivel'].")'>Cambiar a usuario</a>" : "<a href='javascript:cambiarNivel(".$row['id'].",".$row['nivel'].")'>Cambiar a administrador</a>" )."</td>"?>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php }else{ ?>

    <?php
$orden = "l.id";

if  (isset($_GET['orden']))
{
    $orden = $_GET['orden'];
}


if (isset($_GET['ascdesc']))
{

    if($_GET["ascdesc"] == "asc"){
        $ascdesc= "desc";
    }else{
        $ascdesc= "asc";
    }
} else
{
    $ascdesc= "asc";
}


$sql = "SELECT l.id, l.imagen as fotografia, l.titulo, l.autor,l.anio, e.editorial, u.usuario,c.carrera 
    FROM libros l
    LEFT JOIN editoriales e ON e.id = l.ideditorial
    LEFT JOIN carreras c on c.id = l.idcarrera
    LEFT JOIN usuarios u on u.id = l.idusuario
    order by $orden $ascdesc";
    $resultado = $con->query($sql); 




?>


<table style="border-collapse: collapse" border="1" >
    <thead>
        <tr>
            <th >Fotografia</th>
            <th ><a href="javascript:pregunta4('listar.php?orden=titulo&ascdesc=<?php echo ($orden == "titulo" ? $ascdesc: "desc")?>',4)">Titulo</a></th>
            <th ><a href="javascript:pregunta4('listar.php?orden=autor&ascdesc=<?php echo ($orden == "autor" ? $ascdesc: "desc")?>',4)">Autor</a></th>
            <th ><a href="javascript:pregunta4('listar.php?orden=anio&ascdesc=<?php echo ($orden == "anio" ? $ascdesc: "desc")?>',4)">Anio</a></th>
            <th ><a href="javascript:pregunta4('listar.php?orden=editorial&ascdesc=<?php echo ($orden == "editorial" ? $ascdesc: "desc")?>',4)">Editorial</a></th>
            <th ><a href="javascript:pregunta4('listar.php?orden=usuario&ascdesc=<?php echo ($orden == "usuario" ? $ascdesc: "desc")?>',4)">Usuario</a></th>
            <th ><a href="javascript:pregunta4('listar.php?orden=carrera&ascdesc=<?php echo ($orden == "carrera" ? $ascdesc: "desc")?>',4)">Carrera</a></th>
        </tr>
    </thead>
    
 <?php 
 while($row=mysqli_fetch_array($resultado)){
    ?>
    <tr>
        <td><img src="images/<?php echo $row['fotografia'];  ?>" width="50px"></td>
        <td><?php echo $row['titulo'];?></td>
        <td><?php echo $row['autor'];?></td>
        <td><?php echo $row['anio'];?></td>
        <td><?php echo $row['editorial'];?></td>
        <td><?php echo $row['usuario'];?></td>
        <td><?php echo $row['carrera'];?></td>
    </tr>
    <?php } ?>
 </table>



<?php }?>
      
