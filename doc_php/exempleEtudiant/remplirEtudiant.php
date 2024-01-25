<?php
include 'mesFonctionsGenerales.php';

// Connexion à la base de données BDEtudiant
$cnxBDD = connexion();

// les noms sont dans le fichier nom.txt
$NomFichier = 'nom.txt';
$TabloNomFamille = file($NomFichier);

// les prenoms garcon sont dans le fichier garcon.txt
$NomFichier = 'garcon.txt';
$TabloPrenom = file($NomFichier);

// Nombre d'étudiants à ajouter
$nombreEtudiants = 10;

// Ajout de 10 étudiants
for ($i = 1; $i <= $nombreEtudiants; $i++) {
	$n = rand(0, sizeof($TabloNomFamille) - 1);
	$p = rand(0, sizeof($TabloPrenom) - 1);
}

$sql = "INSERT INTO etudiant(nom, prenom) VALUES ('$TabloNomFamille[$n]', '$TabloPrenom[$p]');";

function hello_

echo "Sql : " . $sql . "<br />";
$result = $cnxBDD->query($sql)
	or die("Requete invalide : " . $sql);

// Fermer la connexion MYSQL
$cnxBDD->close();
