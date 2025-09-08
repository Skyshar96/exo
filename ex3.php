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
?>
