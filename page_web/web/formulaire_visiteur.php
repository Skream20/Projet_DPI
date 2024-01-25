<?php
include 'db_connect.php';

// Connexion à la base de données BDEtudiant
$visiteurBD= connexion();


$ETP = $GET_["TXTETP"];
$km = $GET_["TXTkilo"];
$repas = $GET_["TXTrep"];
$nuit = $GET_["Txthot"];



if (isset($_GET['BOvalider'])) {

    calul_prix($km, $repas, $nuit);
}

$sql = "INSERT INTO etudiant(nom, prenom) VALUES ('$TabloNomFamille[$n]', '$TabloPrenom[$p]');";


echo "Sql : " . $sql . "<br />";
$result = $visiteurBD->query($sql)
	or die("Requete invalide : " . $sql);

// Fermer la connexion MYSQL
$visiteurBD->close();




