<?php 
$n = $_POST["n"];
for ($i = 1; $i <= $n; $i++) { ?>
    <form action="form-introducir.php" method="post">
        <input type="hidden" name="n" value="<?php echo $n; ?>">

?>