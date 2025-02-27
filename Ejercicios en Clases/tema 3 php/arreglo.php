<?php 
    $dias = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
    echo "los dias de la semana son: <br>";
    foreach ($dias as $dia){
        echo $dia . "<br>";
    }
    $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto","Septiembre", "Octubre", "Noviembre", "Diciembre"];

    echo "<br> Los meses del año son: <br>";
    foreach ($meses as $mes){
        echo $mes . "<br>";
    }

    //arreglo asociativo
    $persona = array("nombre"=> "Juan", "apellido" => "Perez", "edad" => 30);
    echo "<br> Datos de la persona: <br>";
    foreach($persona as $clave => $valor){
        echo $clave . ": " . $valor . "<br>";
    }


    //lista alumnos
    $alumno1 = array("nombre" => "Juan", "apellido" => "Perez", "edad" => 30);
    $alumno2 = array("nombre" => "Maria", "apellido" => "Gomez", "edad" => 25);
    $alumno3 = array("nombre" => "Pedro", "apellido" => "Gonzalez", "edad" =>35);

    $lista_alumnos = [$alumno1, $alumno2, $alumno3];
    echo "<br> Lista de alumnos: <br>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<th>Nombre</th><th>Apellido</th><th>Edad</th>";
    foreach($lista_alumnos as $alumno){
        echo "<tr>";
        echo "<td>" . $alumno["nombre"] . "</td>";
        echo "<td>" . $alumno["apellido"] . "</td>";
        echo "<td>" . $alumno["edad"] . "</td>";
        echo "</tr>";
    }
?>