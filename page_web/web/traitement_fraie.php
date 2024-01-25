
<?php
include 'db_connect.php';


# On récupère les données du formulaire GET
$ETP = $GET_["TXTETP"];
$km = $GET_["TXTkilo"];
$repas = $GET_["TXTrep"];
$nuit = $GET_["Txthot"];

#calule fiche de fraie
function calcule_remboursement($km, $repas, $nuit, $ETP)
{

    $km *= 0.62;
    #etape
    $ETP *= 110;
    $nuit *= 80;
    $repas *= 29;


    $T = $nuit + $repas + $km + $ETP;


    return [
        'Total' => $T,
        'FraisNuitT' => $nuit,
        'FraisRepasT' => $repas,
        'FraisKmt' => $km,
        'FraisETPT' => $ETP
    ];
}


if (isset($_GET['BOvalider'])) {

    calcule_remboursement($km, $repas, $nuit, $ETP);
}

#ETP	Forfait Etape	110.00
#modifier	KM	Frais Kilométrique	000.62
#modifier	NUI	Nuitée Hôtel	080.00
#modifier	REP	Repas Restaurant	025.00