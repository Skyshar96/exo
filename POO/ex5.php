<?php
declare(strict_types=1);

// Base class Employe
abstract class Employe
{
	public function __construct(protected string $nom)
	{
	}

	public function getNom(): string
	{
		return $this->nom;
	}

	// Chaque sous-classe doit fournir sa propre présentation
	abstract public function presenter(): void;
}

// Classe Ouvrier
class Ouvrier extends Employe
{
	public function __construct(string $nom, private ?string $poste = null)
	{
		parent::__construct($nom);
	}

	public function presenter(): void
	{
		$poste = $this->poste ? " (poste: {$this->poste})" : '';
		echo "Bonjour, je suis Ouvrier, je m'appelle {$this->nom}{$poste}." . PHP_EOL;
	}
}

// Classe Manager
class Manager extends Employe
{
	public function __construct(string $nom, private string $service = 'Général', private int $nbCollaborateurs = 0)
	{
		parent::__construct($nom);
	}

	public function presenter(): void
	{
		echo "Bonjour, je suis Manager du service {$this->service}, je m'appelle {$this->nom} et je supervise {$this->nbCollaborateurs} collaborateur(s)." . PHP_EOL;
	}
}

// Tableau d’employés mixtes
$employes = [
	new Ouvrier('Alice', 'Assemblage'),
	new Manager('Bob', 'Production', 5),
	new Ouvrier('Charlie'),
	new Manager('Diane', 'Qualité', 2),
];

// Appeler presenter() dans une boucle
foreach ($employes as $employe) {
	$employe->presenter();
}

