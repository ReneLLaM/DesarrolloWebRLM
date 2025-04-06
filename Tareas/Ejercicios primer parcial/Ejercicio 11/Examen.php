<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php 
class Examen{
    public $cadena1;
    public $cadena2;

    function __construct($cadena1, $cadena2){
        $this->cadena1 = $cadena1;
        $this->cadena2 = $cadena2;
    }

    function cruzar(){
        $fila = 0;
        $columna = 0;
        $esComun = false;

        $cadena1 = str_split($this->cadena1);
        $cadena2 = str_split($this->cadena2);

        for($i = 0; $i < count($cadena1); $i++){
            $letra1 = $cadena1[$i];

            for($j = 0; $j < count($cadena2); $j++){
                $letra2 = $cadena2[$j];

                if($letra1 == $letra2){
                    $esComun = true;
                    $fila = $i;
                    $columna = $j;
                    break;
                    
                }
            }
            if($letra1 == $letra2){
                break;
            }
        }
        ?>

        <?php if($esComun){?>
            <table border="1">
                <?php for($i = 0; $i < count($cadena2); $i++){?>
                    <tr>
                        <?php for($j = 0; $j < count($cadena1); $j++){?>
                            <?php if($i == $columna){?>
                                <td> <?php echo $cadena1[$j]; ?></td>
                            <?php }else{?>
                                <?php if($j == $fila){?>
                                    <td> <?php echo $cadena2[$i]; ?></td>
                                <?php }else{?>
                                <td></td>
                                <?php }?>
                            <?php }?>
                        <?php } ?>
                    </tr>

                <?php } ?>
            </table>
        <?php }else{
            echo "no existen letras comunes";
        }
    }

}


?>
</body>
</html>