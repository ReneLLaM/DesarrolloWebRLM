<?php 
$numeroPalabras = $_POST["numeroPalabras"];

echo "<form action='ordenar.php' method='post'>";
for ($i = 1; $i <= $numeroPalabras; $i++) {
    echo "<label for='palabra" . $i . "'>Palabra " . $i . ": </label>";
    echo "<input type='text' name='palabra" . $i . "'><br>";
}
echo "<input type='hidden' name='numeroPalabras' value='" . $numeroPalabras . "'>";
echo "<input type='submit' value='Enviar'>";
echo '</form>';
?>

