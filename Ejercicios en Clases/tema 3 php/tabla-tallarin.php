<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border='1' style='border-collapse: collapse;'>
    <?php
    $n = 10;
    $m = 5;


    for ($i = 1; $i <= $n; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $m; $j++) {
            echo "<td> $j </td>";
        }
        echo "</tr>";
    }

    ?>
    </table>
</body>
</html>