<?php
include 'db_connect.php';

// Connexion à la base de données BDEtudiant
$visiteurBD = connexion();

$id = $_GET["TxTID"];
$nom = $_GET["TxTNom"];
$prenom = $_GET["TxTprenom"];
$adress = $_GET["TxTadresse"];
$ville = $_GET["TxTville"];
$CP = $_GET["TxTcp"];
$date_emb = $_GET["TxTembauche"];
$login = $_GET["TxTlogin"];
$mdp = $_GET["TxTmdp"];

/*
$date = horloge();

function horloge()
{
    $datejour = new DateTime();
    $Joursemaine = $datejour->format("l");
    $joursmois = $datejour->format("d");
    $mois = $datejour->format("F");
    $annee = $datejour->format("Y");
    $heure = $datejour->format("H:i");

    echo "Le $Joursemaine $joursmois $mois $annee à $heure";
}
*/


#enregistre user

function visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp, $date)
{
    // Préparation de la requête SQL (ajustez les colonnes et les valeurs en conséquence)
    $sql = "INSERT INTO visiteur(VIS_ID, VIS_PRENOM, VIS_NOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) 
            VALUES ('$id', '$prenom', '$nom', '$adress', '$CP', '$ville', '$date_emb')
            ";
    $sql2 = "INSERT INTO USER(VIS_ID, login,password)values('$id', '$login','$mdp')";

    echo "Sql : " . $sql . "<br />";
    echo "sql :" . $sql2 . "<br/>";

    // Exécution de la requête
    $result = $visiteurBD->query($sql);
    $result2 =  $visiteurBD->query($sql2);

    if ($result === TRUE) {
        echo "Enregistrement ajouté avec succès.<br/>";
        #echo "Voulez vous login?"
        #if 
    } else {
        echo "Erreur lors de l'ajout de l'enregistrement : " . $visiteurBD->error . "<br/>";
    }

    if ($result2 === TRUE) {
        echo "Enregistrement ajouté avec succès.";
        #echo "Voulez vous login?"
        #if 
    } else {
        echo "Erreur lors de l'ajout de l'enregistrement : " . $visiteurBD->error . "<br/>";
    }
}

if (isset($_GET['submit'])) {
    while (true) {
        visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp, $date);
    }
}

// Fermer la connexion MYSQL à la fin du script
$visiteurBD->close();
