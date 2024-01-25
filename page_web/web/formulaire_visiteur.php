<?php
include 'db_connect.php';

// Connexion à la base de données BDEtudiant
$visiteurBD= connexion();


$id = $GET_["TxTID"];
$nom = $GET_["TxTNom"];
$prenom = $GET_["TxTprenom"];
$adress = $GET_["TxTadresse"];
$ville = $GET_["TxTville"];
$CP = $GET_["TxTcp"];
$date_emb = $GET_["embauche"];
$login = $GET_["login"];  
$mdp =$GET_["TxTmdp"];

function visiteur($id,$nom,$prenom,$adress,$ville,$CP,$date_emb,$login,$mdp){
    while (True){
        $sql = "INSERT INTO visiteur(VIS_ID,VIS_PRENOM,VIS_NOM,VIS_ADRESSE,VIS_CP,VIS_VILLE,VIS_DATE_EMBAUCHE) VALUES ('$id','$nom','');";

    }



}


if (isset($_GET['submit'])) {

    visiteur($id,$nom,$nom,$prenom,$adress,$ville,$CP,$date_emb,$login,$mdp);
}



echo "Sql : " . $sql . "<br />";
$result = $visiteurBD->query($sql)
	or die("Requete invalide : " . $sql);

// Fermer la connexion MYSQL
$visiteurBD->close();







