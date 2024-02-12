<?php
include 'db_connect.php';

$cnxBDD = connexion();



# On récupère les données du formulaire GET
$ETP = $GET_["TXTETP"];
$km = $GET_["TXTkilo"];
$repas = $GET_["TXTrep"];
$nuit = $GET_["Txthot"];
$ETP = $GET_["TxTetape"];

#calule fiche de fraie
function calcule_remboursement($km, $repas, $nuit, $ETP)
{
    $km = 0.62;
    $ETP = 110;
    $nuit = 80;
    $repas= 25;
    $T = $nuit + $repast + $km + $ETP;
    #faire calcule
    return [
        'Total' => $T,
        'FraisNuitT' => $nuit,
        'FraisRepasT' => $repas,
        'FraisKmt' => $km,
        'FraisETPT' => $ETP
    ];
}

#insert dans la BDD
function fraie_visiteur($km, $repas, $nuit, $ETP)
{
    calcule_remboursement($km, $repas, $nuit, $ETP);

    $sql = "INSERT INTO frais_forfait(FOR_ID,FOR_LIB,FOR_MONTANT)
    VALUES ('REP','REPAS','$repas')";

    $sql = "INSERT INTO frais_forfait(FOR_ID,FOR_LIB,FOR_MONTANT)
    VALUES ('NUIT','REPAS','$nuit')";

    $sql = "INSERT INTO frais_forfait(FOR_ID,FOR_LIB,FOR_MONTANT)
    VALUES ('KM','REPAS','$km')";

    $sql = "INSERT INTO frais_forfait(FOR_ID,FOR_LIB,FOR_MONTANT)
    VALUES ('ETP','REPAS','$ETP')";

    // Exécution de la requête
    echo "Sql : " . $sql . "<br />";
}

if (isset($_GET['BOvalider'])) {

    fraie_visiteur($km, $repas, $nuit, $ETP)
}

$result = $cnxBDD->query($sql);