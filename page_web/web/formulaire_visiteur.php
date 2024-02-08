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

function visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp)
{
    // Préparation de la requête SQL (ajustez les colonnes et les valeurs en conséquence)
    $sql = "INSERT INTO visiteur(VIS_ID, VIS_PRENOM, VIS_NOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE, VIS_ID_login, VIS_ID_password) 
            VALUES ('$id', '$prenom', '$nom', '$adress', '$CP', '$ville', '$date_emb', '$login', '$mdp')";

    echo "Sql : " . $sql . "<br />";

    // Exécution de la requête
    $result = $visiteurBD->query($sql);

    if ($result === TRUE) {
        echo "Enregistrement ajouté avec succès.";
        #echo "Voulez vous login?"
        #if 
    } else {
        echo "Erreur lors de l'ajout de l'enregistrement : " . $visiteurBD->error;
    }
}

if (isset($_GET['submit'])) {
    while (true) {
        visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp);
    }
}

// Fermer la connexion MYSQL à la fin du script
$visiteurBD->close();
