<?php
include "db_connect.php";

if (isset($_POST['id'])) {
    $idUtilisateur = $_POST['id'];

    $cnxBDD = connexion();

    $sqlSuppression = "DELETE FROM visiteur WHERE VIS_ID = '$idUtilisateur'";
    $resultSuppression = $cnxBDD->query($sqlSuppression);
    if ($resultSuppression === TRUE) {
        echo "Visiteur supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du visiteur : " . $cnxBDD->error;
    }
    $cnxBDD->close();
    header("Location: liste_visit.php");
    
} else {

    header("Location: liste_visit.php");
    exit();
}
?>
