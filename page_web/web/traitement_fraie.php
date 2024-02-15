<?php
include 'db_connect.php';

$cnxBDD = connexion();



# On récupère les données du formulaire GET
$ETPt = $GET_["TXTETP"];
$kmt = $GET_["TXTkilo"];
$repast = $GET_["TXTrep"];
$nuitt = $GET_["Txthot"];
$ETPt = $GET_["TxTetape"];
$mois = $GET_["TxtMois"];
$id = $_GET["TxTID"];

#remplire FFR_ID

#calule fiche de fraie
function calcule_remboursement($kmt, $repast, $nuitt, $ETPt)
{
    $km = 0.62;
    $ETP = 110;
    $nuit = 80;
    $repas = 25;
    #totale
    $T = $nuit * $nuitt + $repas * $repast + $km * $kmt + $ETP * $ETPt;


    return [
        'Total' => $T,
        'FraisNuitT' => $nuit,
        'FraisRepasT' => $repas,
        'FraisKmt' => $km,
        'FraisETPT' => $ETP
    ];
}



//remplissage de la base de donnée fiche_frais
#insert dans la BDD
function fraie_visiteur($km, $repas, $nuit, $ETP, $id)
{
    calcule_remboursement($km, $repas, $nuit, $ETP);

    $sql = "INSERT INTO fiche_frais(FFR_ID, VIS_ID, ETA_ID, FFR_ANNEE, FFR_MOIS, FFR_MONTANT_VALIDE, FFR_NB_JUSTIFICATIF, FFR_DATE_MODIF)
    VALUES ( '$id',)";

    // Exécution de la requête
    echo "Sql : " . $sql . "<br />";
}

if (isset($_GET['BOvalider'])) {
    include 'remplir_id.php';
    fraie_visiteur($km, $repas, $nuit, $ETP, $id);
}


$result = $cnxBDD->query($sql);