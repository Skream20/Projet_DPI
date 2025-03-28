<?php
include 'db_connect.php';

$cnxBDD = connexion();

$mois = date('m');
$anne = date('Y');

$km = $_GET['TxTKm'];
$repas = $_GET['TxTRepas'];
$nuit = $_GET['TxTNuit'];
$etape = $_GET['TxTEtape'];

function getNextFFR_ID()
{
    global $cnxBDD;

    $query = "SELECT FFR_ID FROM ligne_frais_forfait ORDER BY FFR_ID DESC LIMIT 1";
    $result = $cnxBDD->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $next_id = $row['FFR_ID'] + 1;
    } else {
        $next_id = 1;
    }

    return $next_id;
}

function rid($km, $repas, $nuit, $etape)
{
    global $cnxBDD;

    $i = getNextFFR_ID();

    // Perform the loop only once
    $r_id = "INSERT INTO ligne_frais_forfait(FFR_ID, FOR_ID, LIG_QTE)
        VALUES 
        ($i, 'km', '$km'),
        ($i, 'NUI', '$nuit'),
        ($i, 'ETP', '$etape'),
        ($i, 'REP', '$repas')";

    echo "Sql : " . $r_id . "<br />";

    $res_id = $cnxBDD->query($r_id);
}

rid($km, $repas, $nuit, $etape);

