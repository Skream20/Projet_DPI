<?php
include "db_connect.php";

if (isset($_GET['id'])) {
    $idUtilisateur = $_GET['id'];

    $cnxBDD = connexion();

    $sqlSuppression = "DELETE FROM visiteur WHERE VIS_ID = '$idUtilisateur'";
    $resultSuppression = $cnxBDD->query($sqlSuppression);

    header("Location: liste_visit.php");
    $cnxBDD->close();
} else {

    header("Location: liste_visit.php.php");
    exit();
}
?>
