<?php
class Livre {
    public $titre;
    public $auteur;

        public function __construct($titre, $auteur) {
        $this ->titre = $titre;
        $this ->auteur = $auteur;
    }
}

$monLivre = new Livre("George Orwell","Le Petit Prince” de Saint-Exupéry");
$monLivre -> auteur = "George Orwell";
$monLivre -> titre = "Le Petit Prince” de Saint-Exupéry";
echo $monLivre -> auteur;
?>