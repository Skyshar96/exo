<?php
class Etudiant {
    private $nom;
    private float $note;

    public function __construct(string $nom, float $note =0.0) {
        $this -> nom = $nom;
        $this -> note = $note;

    }
    public function getnom(){
        return $this -> nom;

    }

}

?>