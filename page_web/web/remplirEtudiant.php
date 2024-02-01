<?php
include 'db_connect

.php';

// Connexion à la base de données BDEtudiant
$cnxBDD = connexion();

// les noms sont dans le fichier nom.txt
$NomFichier = 'nom.txt';
$TabloNomFamille = file($NomFichier);

// les prenoms garcon sont dans le fichier garcon.txt
$NomFichier = 'garcon.txt';
$TabloPrenom = file($NomFichier);

$NomFichier = 'adresse.txt';
$TabloAdress = file($NomFichier);

// rand(x, y) fournit un nombre au hasard entre x et y
$n = rand(1, sizeof($TabloNomFamille));			// $n contient un numéro de ligne au hasard
$p = rand(1, sizeof($TabloPrenom));			// $p contient un un numéro de ligne au hasard
$a = rand(1, sizeof($TabloAdress));
$firstLetterFirstName = substr($firstName, 0, 1);
$firstLetterLastName = substr($lastName, 0, 1);
$id = $firstLetterFirstName . $firstLetterLastName;

// Insertion dans la table ETUDIANT du ni�me nom de famille et du pi�me pr�nom 
$sql = "INSERT INTO visiteur(VIS_ID,VIS_PRENOM, VIS_NOM,VIS_ADRESSE) VALUES ('$id','$TabloNomFamille[$n]', '$TabloPrenom[$p]','$TabloAdress[$a]');";

echo "Sql : " . $sql . "<br />";
$result = $cnxBDD->query($sql)
	or die("Requete invalide : " . $sql);

// Fermer la connexion MYSQL
$cnxBDD->close();
