<?php
class Operaciones {
    private $a;
    private $b;
    private $c;

    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
    public function hola(){
        echo "hola";
    }

    public function sumar() {
        return $this->a + $this->b + $this->c;
    }

    public function restar() {  
        return $this->a - $this->b - $this->c;
    }

    public function multiplicar() {
        return $this->a * $this->b * $this->c;
    }

    public function dividir() {
        return $this->a / $this->b / $this->c;
    }
}

$op = new Operaciones(1, 2, 3);
?>

<?php 

?>