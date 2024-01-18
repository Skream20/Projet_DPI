#information : le killomètrage (kilo) , repas (rep) , séjour à l'hotel (hot)
<?php
# On récupère les données du formulaire GET
$ETP = $GET_["TXTETP"];
$km = $GET_["TXTkilo"];
$repas = $GET_["TXTrep"];
$nuit = $GET_["Txthot"];

#calule fiche de fraie
function calcule_remboursement($km, $repas, $nuit)
{
    # Calcule des frais de transport
    $km = $km * 0.62;

    # Calcul du total des frais de nuit et repas
    $nuitT = $nuit * 80;
    $remT = $repas * 29;
    $km = (float)$km;
    $T = $nuitT + $remT + $km;

    # Affiche les valeurs
    echo ("");
    echo ("forfaie étape: $ETP");
    echo ("Nuitée $nuit * 80 = $nuitT</br>");
    echo ("Repas $repas * 29 = $remT</br>");
    echo ("Frais véhicule : $km</br>");
    echo ("TOTAL : $T");
}

if (isset($_GET['BOvalider'])) {

    calul_prix($km, $repas, $nuit);
}


#ETP	Forfait Etape	110.00
#modifier	KM	Frais Kilométrique	000.62
#modifier	NUI	Nuitée Hôtel	080.00
#modifier	REP	Repas Restaurant	025.00