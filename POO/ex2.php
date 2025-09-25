<?php
class Etudiant {
    private string $nom;
    private float $note;

    public function __construct(string $nom, float $note = 0.0) {
        $this -> nom = $nom;
        $this -> setNote ($note);

    }
    public function getnom(): string{
        return $this -> nom;
    }
    public function getNote(): float{
        return $this -> note;
    }
    public function setNote(float $note): void {
        if ($note < 0.0 || $note > 20.0) {
            throw new InvalidArgumentException("La note doit etre entre 0 et 20."); 
        }
    $this -> note = $note;
    }
    public function afficher(): void {
        echo "Nom : {$this -> nom} - Note : {$this -> note}";

    }
}

?>