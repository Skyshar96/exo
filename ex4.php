<?php
$tab1 = [8, 34, 2, 87, 37];

function getMax($array) {
    return max($array);
}

echo "Le plus grand nombre est : " . getMax($tab1);

function getMin($array) {
    return min($array);
}

echo "Le plus petit nombre est : " . getMin($tab1);

function hasDuplicates($array) {
    return count($array) !== count(array_unique($array));
}

// Exemple d'utilisation :
if (hasDuplicates($tab1)) {
    echo "Il y a des doublons dans le tableau.";
} else {
    echo "Il n'y a pas de doublons dans le tableau.";
}
?>
