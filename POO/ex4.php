<?php

abstract class Employer {
    protected string $nom;

    public function __construct(string $nom) {
        $this->nom = $nom;
    }

    abstract public function calculerSalaire(): float;
}

class Ouvrier extends Employer {
    private float $tauxHoraire;
    private int $heures;

    public function __construct(string $nom, float $tauxHoraire, int $heures) {
        parent::__construct($nom);
        $this->tauxHoraire = $tauxHoraire;
        $this->heures = $heures;
    }

    public function calculerSalaire(): float {
        return $this->tauxHoraire * $this->heures;
    }
}
class Manager extends Employer {
    private string $salaireBase;
    private float $prime;
        public function __construct(string $nom,float $salaireBase, float $prime = 0.0) {
            parent::__construct($nom);
            $this -> salaireBase = $salaireBase;
            $this -> prime = $prime;
        }
    public function calculerSalaire(): float {
        return $this->salaireBase + $this->prime;
    }
    
}
?>