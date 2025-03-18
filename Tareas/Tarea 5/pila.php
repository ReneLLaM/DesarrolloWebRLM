<?php 
class Pila{

    private $elementos = array();
    private $tope = 0;

    public function insertar($e){
        $this->elementos[$this->tope] = $e;
        $this->tope++;
    } 

    public function eliminar(){
        if($this->tope > 0){
            $elementoEliminado = $this->elementos[$this->tope - 1];
            unset($this->elementos[$this->tope - 1]);
            $this->tope--;
            return $elementoEliminado;
        }
        return null;
    }

    public function mostrar(){
        for($i = $this->tope - 1; $i >= 0; $i--){
            echo $this->elementos[$i] . "<br>";
        }
    }

}
?>