<?php
$evenements = [
    "Formation PHP" => ["debut" => "2024-10-01", "fin" => "2024-10-15"],
    "Stage en entreprise" => ["debut" => "2024-11-01", "fin" => "2024-11-30"],
    "Examen final" => ["debut" => "2024-12-10", "fin" => "2024-12-12"],
];

$date_actuelle = date('Y-m-d');
$timestamp_actuel = strtotime($date_actuelle);

foreach ($evenements as $nom => $dates) {
    $debut = strtotime($dates['debut']);
    $fin = strtotime($dates['fin']);
    if ($timestamp_actuel < $debut) {
        $etat = "À venir";
    } elseif ($timestamp_actuel >= $debut && $timestamp_actuel = $fin) {
        $etat = "En cours";
    } else {
        $etat = "Terminé";
    }
    echo "$nom : $etat\n";
}
