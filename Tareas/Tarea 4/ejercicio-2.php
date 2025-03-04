<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>ejercicio 2</title>
    <style>
        .container{
            display: flex;
            justify-content: center;
        }
        table{
            width: 300px;
            border-collapse: collapse; 
        }
        table td{
            padding: 5px 15px 15px 5px; 
            font-weight: bold;
        }
        .valor{
            background-color: #00b050;
            border: 2px solid black
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
    $num1 = $_GET["numero-1"];
    $num2 = $_GET["numero-2"];
    $suma = $num1 + $num2;
    echo "<table border='2'>";
    echo "<tr>";
        echo "<td class='valor'>$num1</td>";;
        echo "<td>+</td>";
        echo "<td class='valor'>$num2</td>";
        echo "<td> = </td>";
        echo "<td class='valor'>$suma</td>";
    echo "</tr>";
    echo "</table>";
    ?>
    </div>
</body>
</html>