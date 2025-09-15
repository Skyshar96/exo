
<?php
$notes = [
	'Dupont' => ['anglais' => 12, 'français' => 9, 'math' => 8],
	'Franck' => ['anglais' => 2, 'français' => 19, 'math' => 12],
	'Alice' => ['anglais' => 10, 'français' => 11, 'math' => 10],
	'Stephane' => ['anglais' => 14, 'français' => 15, 'math' => 18],
	'Coralie' => ['anglais' => 12, 'français' => 19, 'math' => 5],
];

// Affichage du tableau pour vérification
print_r($notes);
echo "\n\n";

foreach ($notes as $nom => $matieres) {
	$moyenne = array_sum($matieres) / count($matieres);
	if ($moyenne >= 10) {
		echo "$nom a obtenu l'examen avec une moyenne de " . number_format($moyenne, 2) . "\n";
	}
}
