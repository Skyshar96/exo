<?php
class Vehicule {
    public function rouler(){
        echo "Le vehicule roule";
    }
}
class Moto extends Vehicule {
    public function rouler(){
        echo "La moto roule \n";
    }
}
$moto = new Moto();
$moto-> rouler();

?>