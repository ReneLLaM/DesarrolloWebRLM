<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="mostrar.php" method="post">
        <label for="nombres">Nombres:</label>
        <input type="text" name="nombres">
        <br>
        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos">
        <br>
        <label for="sexo">Sexo:</label>
        <select name="sexo" >
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select>
        <br>
        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion">
        <br>
        <label for="celular">Celular:</label>
        <input type="number" name="celular">
        <br>
        <label for="correo">correo:</label>
        <input type="email" name="correo">
        <br>
        <input type="submit" value="mostrar">
        
    </form>
</body>
</html>