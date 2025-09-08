<?php

# exemple de jeu du pendu
echo "Jeu du pendu : retrouvez le mot mystère !\n" ;
$mot_a_trouver = "PROGRAMMATION" ;
$mot_a_completer = "_____________" ;
$essais_restants = 12 ;
while($mot_a_completer != $mot_a_trouver && $essais_restants > 0){
    echo "Mot à compléter : {$mot_a_completer}\n" ;
    echo "Nombre d'essais restants : {$essais_restants}\n" ;
    $lettre = readline("Indiquez votre lettre en majuscule, et validez avec la touche Entrée : ") ;
    $lettre_absente = true ;
    for($i = 0; $i < strlen($mot_a_trouver); $i++){
        if($mot_a_trouver[$i] == $lettre){
            $mot_a_completer[$i] = $lettre;
            $lettre_absente = false;
        }
    }
    if($lettre_absente){
        $essais_restants -= 1 ;
    }
}
if($essais_restants > 0){
    echo "Bravo ! Vous avez trouvé le mot mystère : {$mot_a_trouver}\n" ;
}
else{
    echo "Pendu ! Le mot mystère était {$mot_a_trouver}\n" ;
}