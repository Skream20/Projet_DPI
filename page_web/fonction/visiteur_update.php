<?php

function modifierVisiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp)
{

    $sql = "UPDATE visiteur SET 
            VIS_PRENOM = '$prenom', 
            VIS_NOM = '$nom', 
            VIS_ADRESSE = '$adress', 
            VIS_CP = '$CP', 
            VIS_VILLE = '$ville', 
            VIS_DATE_EMBAUCHE = '$date_emb' 
            WHERE VIS_ID = '$id'";

    $sql2 = "UPDATE USER SET 
             login = '$login', 
             password = '$mdp' 
             WHERE VIS_ID = '$id'";

    echo "Sql : " . $sql . "<br />";
    echo "sql :" . $sql2 . "<br/>";

    // Exécution de la requête
    $result = $visiteurBD->query($sql);
    $result2 =  $visiteurBD->query($sql2);

    if ($result === TRUE && $result2 === TRUE) {
        echo "Enregistrement mis à jour avec succès.<br/>";
        header('Location: liste_visit.php');
        exit(); // Ensure script stops execution after redirect
    } else {
        echo "Erreur lors de la mise à jour de l'enregistrement : " . $visiteurBD->error . "<br/>";
    }
}
