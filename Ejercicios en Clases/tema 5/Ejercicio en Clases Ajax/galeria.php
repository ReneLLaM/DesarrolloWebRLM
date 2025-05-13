<?php
include("conexion.php");
$sql = "SELECT id, imagen FROM libros";
$resultado = $con->query($sql);
?>

<table style="border-collapse: collapse" border="1">
    <tr>
        <?php
        $cont = 0;
        while ($row = mysqli_fetch_array($resultado)) {
            if ($cont == 3) {
                $cont = 0;
                echo "</tr><tr>";
            }
        ?>
            <td><img src="images/<?php echo $row['imagen']; ?>" width="50px" class="gallery-img" onclick="openModal(this.src)"></td>
        <?php
            $cont++;
        }
        ?>
    </tr>
</table>

<!-- Modal -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <img id="modalImage" class="modal-img">
        <br>
        <button class="accept-btn" onclick="closeModal()">Aceptar</button>
    </div>
</div>