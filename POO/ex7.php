<?php
declare(strict_types=1);

// 7. POO + Base de Données avec PDO (sans ORM)
// - Entité Produit (id, nom, prix)
// - ProduitRepository: findAll(), findById(int $id), insert(string $nom, float $prix)
// - Bootstrap: création DB/table si nécessaire, insertion de 2–3 produits (si table vide), affichage

class Produit
{
	public function __construct(
		private int $id,
		private string $nom,
		private float $prix
	) {
		$this->assertValid($nom, $prix);
	}

	private function assertValid(string $nom, float $prix): void
	{
		$nom = trim($nom);
		if ($nom === '') {
			throw new InvalidArgumentException('Le nom du produit ne peut pas être vide.');
		}
		if (mb_strlen($nom) > 100) {
			throw new InvalidArgumentException('Le nom du produit ne doit pas dépasser 100 caractères.');
		}
		if (!is_finite($prix) || $prix < 0) {
			throw new InvalidArgumentException('Le prix doit être un nombre positif ou nul.');
		}
	}

	public function getId(): int { return $this->id; }
	public function getNom(): string { return $this->nom; }
	public function getPrix(): float { return $this->prix; }
}

class ProduitRepository
{
	public function __construct(private PDO $pdo) {}

	/** @return Produit[] */
	public function findAll(): array
	{
		$stmt = $this->pdo->query('SELECT id, nom, prix FROM produits ORDER BY id ASC');
		$items = [];
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$items[] = new Produit((int)$row['id'], (string)$row['nom'], (float)$row['prix']);
		}
		return $items;
	}

	public function findById(int $id): ?Produit
	{
		$stmt = $this->pdo->prepare('SELECT id, nom, prix FROM produits WHERE id = :id');
		$stmt->execute([':id' => $id]);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row === false) {
			return null;
		}
		return new Produit((int)$row['id'], (string)$row['nom'], (float)$row['prix']);
	}

	public function insert(string $nom, float $prix): int
	{
		// Validation légère côté repo
		$nom = trim($nom);
		if ($nom === '' || mb_strlen($nom) > 100) {
			throw new InvalidArgumentException('Nom invalide (obligatoire, max 100).');
		}
		if (!is_finite($prix) || $prix < 0) {
			throw new InvalidArgumentException('Prix invalide (>= 0).');
		}

		$stmt = $this->pdo->prepare('INSERT INTO produits(nom, prix) VALUES(:nom, :prix)');
		$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
		// Pour DECIMAL, on passe une string formatée pour éviter certains arrondis binaires
		$stmt->bindValue(':prix', number_format($prix, 2, '.', ''), PDO::PARAM_STR);
		$stmt->execute();
		return (int)$this->pdo->lastInsertId();
	}
}

// ---- Bootstrap & Démo ----

function pdoConnectToServer(): PDO
{
	// Connexion au serveur MySQL (sans base) pour créer la DB si nécessaire
	$pdo = new PDO('mysql:host=localhost;charset=utf8mb4', 'root', '', [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
	return $pdo;
}

function ensureDatabase(PDO $serverPdo, string $dbName = 'poo_demo'): void
{
	$serverPdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
}

function pdoConnectToDb(string $dbName = 'poo_demo'): PDO
{
	return new PDO("mysql:host=localhost;dbname={$dbName};charset=utf8mb4", 'root', '', [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
}

function ensureSchema(PDO $pdo): void
{
	$pdo->exec(
		'CREATE TABLE IF NOT EXISTS produits (
			id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			nom VARCHAR(100) NOT NULL,
			prix DECIMAL(10,2) NOT NULL,
			PRIMARY KEY (id)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4'
	);
}

function seedIfEmpty(ProduitRepository $repo, PDO $pdo): void
{
	$count = (int)$pdo->query('SELECT COUNT(*) FROM produits')->fetchColumn();
	if ($count === 0) {
		$repo->insert('Clavier mécanique', 89.90);
		$repo->insert('Souris sans fil', 24.99);
		$repo->insert('Écran 24"', 149.00);
	}
}

try {
	// 1) Connexion au serveur et création de la DB si besoin
	$serverPdo = pdoConnectToServer();
	ensureDatabase($serverPdo, 'poo_demo');

	// 2) Connexion à la DB et création du schéma
	$pdo = pdoConnectToDb('poo_demo');
	ensureSchema($pdo);

	// 3) Repository + éventuel seed
	$repo = new ProduitRepository($pdo);
	seedIfEmpty($repo, $pdo);

	// 4) Démonstration
	echo "Liste des produits:\n";
	foreach ($repo->findAll() as $p) {
		echo $p->getId() . ' — ' . $p->getNom() . ' — ' . number_format($p->getPrix(), 2, ',', ' ') . " €\n";
	}

	// Exemple findById
	$one = $repo->findById(1);
	if ($one) {
		echo "\nProduit #1: " . $one->getNom() . ' (' . number_format($one->getPrix(), 2, ',', ' ') . " €)\n";
	}
} catch (PDOException $e) {
	echo 'Erreur PDO : ' . $e->getMessage() . "\n";
} catch (Throwable $t) {
	echo 'Erreur: ' . $t->getMessage() . "\n";
}

// Bonnes pratiques appliquées:
// - Requêtes préparées pour insert et findById
// - ERRMODE_EXCEPTION activé
// - Propriétés et méthodes typées
// - Accès aux données isolé dans le Repository
// - Validation simple des entrées (nom, prix)

?>
