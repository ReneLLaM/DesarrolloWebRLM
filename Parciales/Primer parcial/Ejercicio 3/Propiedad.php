<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .padre{
            width: 800px;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .hijo{
            width: 600px;
            height: 400px;
            display: flex;

        }
        .hijo img{
            margin: 0 auto;
            height: 350px;
        }
    </style>
</head>
<body>
<?php 
class Propiedad{
    public $item;
    public $color;
    public $color_fondo;
    public $imagen;

    public function __construct($item, $color, $color_fondo, $imagen)
    {
        $this->item = $item;
        $this->color = $color;
        $this->color_fondo = $color_fondo;
        $this->imagen = $imagen;
    }

    public function cuadrado() { ?>
        
        <div class="padre" style="background-color: <?php echo $this->color_fondo ?>;"> 
            <div class="hijo" style="background-color: <?php echo $this->color?>;">
                <img src="<?php echo $this->imagen ?>" alt="">
            </div>
            <p style="text-align: justify; color: white;" ><?php echo $this->item?></p>
        </div>

        
    <?php }
    public function diagonal() { ?>
    
        <?php 
        $tamanioitem = strlen($this->item) ;
        $item = str_split($this->item);
        $contador = 0;
        ?>
        <table>
            <?php for($i = 1; $i<=$tamanioitem; $i++ ){ ?>
                <tr>
                    <?php for($j = 1;$j<=$tamanioitem; $j++ ) {?>

                        <td <?php if($j == $contador +1){?> style="background-color: <?php echo $this->color?>; color: <?php echo $this->color_fondo?>; <?php  } ?> width: 30px;">  
                            <?php 
                            if($j == $contador +1){
                                 echo $item[$contador] ;
                                 
                            }?>
                        </td>

                    <?php }?>
                    <?php $contador++;?>
                </tr>

            <?php }?>
        </table>

        
    <?php }
}

$propiedad = new Propiedad('hreola',  'green','red','bigdata.jpg');
$propiedad->cuadrado();

$propiedad->diagonal();
?>
</body>
</html>