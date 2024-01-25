
<?php

# On récupère les données du formulaire GET
$ETP = $GET_["TXTETP"];
$km = $GET_["TXTkilo"];
$repas = $GET_["TXTrep"];
$nuit = $GET_["Txthot"];

#calule fiche de fraie
function calcule_remboursement($km, $repas, $nuit, $ETP)
{
    # Calcule des frais de transport
    $kmt = $km * 0.62;
    $ETPT = $ETP * 110;
    # Calcul du total des frais de nuit et repas
    $nuitT = $nuit * 80;
    $remT = $repas * 29;
    $T = $nuitT + $remT + $kmt + $ETPT;
}
if (isset($_GET['BOvalider'])) {

    calul_prix($km, $repas, $nuit);
}


#ETP	Forfait Etape	110.00
#modifier	KM	Frais Kilométrique	000.62
#modifier	NUI	Nuitée Hôtel	080.00
#modifier	REP	Repas Restaurant	025.00