<?php
/*
include 'db_connect.php';

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
$idFirstName = substr($TabloPrenom, 0, 1);
$idName = substr(trim($TabloNomFamille[$n]), 0, 1);
$id = $idFirstName . $idName;
echo ($id);
// Insertion dans la table ETUDIANT du ni�me nom de famille et du pi�me pr�nom 
$sql = "INSERT INTO visiteur(VIS_ID,VIS_PRENOM, VIS_NOM,VIS_ADRESSE) VALUES ('$id','$TabloNomFamille[$n]', '$TabloPrenom[$p]','$TabloAdress[$a]');";

echo "Sql : " . $sql . "<br />";
$result = $cnxBDD->query($sql)
	or die("Requete invalide : " . $sql);

// Fermer la connexion MYSQL
$cnxBDD->close();
*/
include 'db_connect.php';

// Connexion à la base de données BDEtudiant
$cnxBDD = connexion();

// les noms sont dans le fichier nom.txt
$NomFichierNom = 'nom.txt';
$TabloNomFamille = file($NomFichierNom);

// les prenoms garcon sont dans le fichier garcon.txt
$NomFichierPrenom = 'garcon.txt';
$TabloPrenom = file($NomFichierPrenom);

// les adresses sont dans le fichier adresse.txt
$NomFichierAdresse = 'adresse.txt';
$TabloAdress = file($NomFichierAdresse);

// Vérification de la connexion à la base de données
if (!$cnxBDD) {
	die("Erreur lors de la connexion à la base de données.");
}

// Génération de numéros de ligne aléatoires
$n = rand(0, count($TabloNomFamille) - 1);
$p = rand(0, count($TabloPrenom) - 1);
$a = rand(0, count($TabloAdress) - 1);

// Extrait la première lettre du prénom
$idFirstName = substr($TabloPrenom[$p], 0, 1);
// Extrait la première lettre du nom de famille
$idName = substr(trim($TabloNomFamille[$n]), 0, 1);
// Concaténation pour former l'ID
$id = $idFirstName . $idName;
echo ($id);

// Échapper les valeurs pour éviter les injections SQL
$visNom = mysqli_real_escape_string($cnxBDD, $TabloNomFamille[$n]);
$visPrenom = mysqli_real_escape_string($cnxBDD, $TabloPrenom[$p]);
$visAdresse = mysqli_real_escape_string($cnxBDD, $TabloAdress[$a]);

// Requête SQL pour l'insertion des données
$sql = "INSERT INTO visiteur(VIS_ID, VIS_PRENOM, VIS_NOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE)
 VALUES ('$id', '$visPrenom', '$visNom', '$visAdresse','29200','BREST','08/02/2024')";

// Exécution de la requête
echo "Sql : " . $sql . "<br />";
$result = $cnxBDD->query($sql);

// Vérification du résultat de la requête
if (!$result) {
	die("Requête invalide : " . $cnxBDD->error);
}

// Fermer la connexion MYSQL
$cnxBDD->close();
