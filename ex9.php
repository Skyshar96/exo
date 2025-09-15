<?php
// Classe abstraite Media
abstract class Media
{
    protected $titre;
    protected $auteur; // Objet Auteur
    private static $compteur = 0;

    public function __construct($titre, Auteur $auteur)
    {
        $this->setTitre($titre);
        $this->setAuteur($auteur);
        self::$compteur++;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function setAuteur(Auteur $auteur)
    {
        $this->auteur = $auteur;
    }

    abstract public function afficherDetails();

    public static function compterMedias()
    {
        return self::$compteur;
    }
}

// Classe Auteur
class Auteur
{
    private $nom;
    private $prenom;

    public function __construct($nom, $prenom)
    {
        $this->setNom($nom);
        $this->setPrenom($prenom);
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function __toString()
    {
        return $this->prenom . ' ' . $this->nom;
    }
}

// Classe Livre
class Livre extends Media
{
    private $anneePublication;

    public function __construct($titre, Auteur $auteur, $anneePublication)
    {
        parent::__construct($titre, $auteur);
        $this->setAnneePublication($anneePublication);
    }

    public function setAnneePublication($annee)
    {
        $this->anneePublication = $annee;
    }

    public function afficherDetails()
    {
        echo $this->__toString() . "\n";
    }

    public function __toString()
    {
        return "Livre : '{$this->titre}' par {$this->auteur} (Année : {$this->anneePublication})";
    }
}

// Classe Ebook
class Ebook extends Media
{
    private $tailleFichier; // en Mo

    public function __construct($titre, Auteur $auteur, $tailleFichier)
    {
        parent::__construct($titre, $auteur);
        $this->setTailleFichier($tailleFichier);
    }

    public function setTailleFichier($taille)
    {
        $this->tailleFichier = $taille;
    }

    public function afficherDetails()
    {
        echo $this->__toString() . "\n";
    }

    public function __toString()
    {
        return "Ebook : '{$this->titre}' par {$this->auteur} (Taille : {$this->tailleFichier} Mo)";
    }
}

// Classe Audiobook
class Audiobook extends Media
{
    private $duree; // en minutes

    public function __construct($titre, Auteur $auteur, $duree)
    {
        parent::__construct($titre, $auteur);
        $this->setDuree($duree);
    }

    public function setDuree($duree)
    {
        $this->duree = $duree;
    }

    public function afficherDetails()
    {
        echo $this->__toString() . "\n";
    }

    public function __toString()
    {
        return "Audiobook : '{$this->titre}' par {$this->auteur} (Durée : {$this->duree} min)";
    }
}

// Création d'auteurs
$a1 = new Auteur("Hugo", "Victor");
$a2 = new Auteur("Rowling", "J.K.");
$a3 = new Auteur("Tolkien", "J.R.R.");

// Création de médias
$livre1 = new Livre("Les Misérables", $a1, 1862);
$livre2 = new Livre("Harry Potter", $a2, 1997);
$ebook1 = new Ebook("Le Seigneur des Anneaux", $a3, 5.2);
$audiobook1 = new Audiobook("Notre-Dame de Paris", $a1, 780);

// Affichage des détails
$medias = [$livre1, $livre2, $ebook1, $audiobook1];
foreach ($medias as $media) {
    $media->afficherDetails();
}

// Affichage du nombre total de médias
echo "Nombre total de médias : " . Media::compterMedias() . "\n";
