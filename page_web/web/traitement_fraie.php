
<?php
include 'db_connect.php';



# On récupère les données du formulaire GET
$ETP = $GET_["TXTETP"];
$km = $GET_["TXTkilo"];
$repas = $GET_["TXTrep"];
$nuit = $GET_["Txthot"];
$ETP = $GET_["TxTetape"];
#calule fiche de fraie
function calcule_remboursement($km, $repas, $nuit, $ETP)
{

    $kmt = 0.62;
    #etape
    $ETPt = 110;
    $nuitt = 80;
    $repast = 29;


    $T = $nuitt + $repast + $kmt + $ETPt;


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