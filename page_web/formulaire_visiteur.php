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

#enregistre user
function visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp)
{
    // Vérification si VIS_ID existe déjà
    $checkSql = "SELECT VIS_ID FROM visiteur WHERE VIS_ID = '$id'";
    $checkResult = $visiteurBD->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "Erreur : L'ID du visiteur existe déjà.<br/>";
        return;
    }

    // Préparation de la requête SQL (ajustez les colonnes et les valeurs en conséquence)
    $sql = "INSERT INTO visiteur(VIS_ID, VIS_PRENOM, VIS_NOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) 
            VALUES ('$id', '$prenom', '$nom', '$adress', '$CP', '$ville', '$date_emb')";
    $sql2 = "INSERT INTO USER(VIS_ID, login, password) VALUES ('$id', '$login', '$mdp')";

    echo "Sql : " . $sql . "<br />";
    echo "sql :" . $sql2 . "<br/>";

    // Exécution de la requête
    $result = $visiteurBD->query($sql);
    $result2 =  $visiteurBD->query($sql2);

    if ($result === TRUE && $result2 === TRUE) {
        echo "Enregistrement ajouté avec succès.<br/>";
        header('Location: liste_visit.php');
        exit(); // Ensure script stops execution after redirect
    } else {
        echo "Erreur lors de l'ajout de l'enregistrement : " . $visiteurBD->error . "<br/>";
    }
}

if (isset($_GET['submit'])) {
    visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp);
}

// Fermer la connexion MYSQL à la fin du script
$visiteurBD->close();

?>

