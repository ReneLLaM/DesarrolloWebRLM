<?php session_start();
if (isset($_SESSION["contador"])) {
    $contador = $_SESSION["contador"];
    $contador++;
    $_SESSION["contador"] = $contador;
} else {
    $contador = 1;
    $_SESSION["contador"] = 1;
}
echo "usted visitoesta pagina $contador veces";

?>