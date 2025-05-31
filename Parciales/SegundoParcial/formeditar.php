<?php 
include("conexion.php");

$id = $_GET['id'];

$stmt = $con->prepare("SELECT l.id, l.imagen as fotografia, l.titulo, l.autor,l.anio, e.editorial, u.usuario,c.carrera 
    FROM libros l
    LEFT JOIN editoriales e ON e.id = l.ideditorial
    LEFT JOIN carreras c on c.id = l.idcarrera
    LEFT JOIN usuarios u on u.id = l.idusuario
    WHERE l.id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $titulo = $row['titulo'];
    $autor = $row['autor'];
    $anio = $row['anio'];
    $editorial = $row['editorial'];
    $usuario = $row['usuario'];
    $carrera = $row['carrera'];
}
?>


<form action="actualizar.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <img src="images/<?php echo $row['fotografia'];  ?>" width="50px">
    <label for="titulo">Titulo</label>
    <input type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>">
    <label for="autor">Autor</label>
    <input type="text" name="autor" id="autor" value="<?php echo $autor; ?>">
    <label for="anio">Anio</label>
    <input type="text" name="anio" id="anio" value="<?php echo $anio; ?>">
    <label for="editorial">Editorial</label>
    <input type="text" name="editorial" id="editorial" value="<?php echo $editorial; ?>">
    <label for="usuario">Usuario</label>
    <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>">
    <label for="carrera">Carrera</label>
    <input type="text" name="carrera" id="carrera" value="<?php echo $carrera; ?>">
    <input type="submit" value="Guardar">
</form>