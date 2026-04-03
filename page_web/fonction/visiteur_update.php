<?php

function modifierVisiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp)
{

    $sql = "UPDATE visiteur SET 
            VIS_PRENOM = ?, 
            VIS_NOM = ?, 
            VIS_ADRESSE = ?, 
            VIS_CP = ?, 
            VIS_VILLE = ?, 
            VIS_DATE_EMBAUCHE = ? 
            WHERE VIS_ID = ?";

    $stmt1 = $visiteurBD->prepare($sql);
    $stmt1->bind_param("sssssss", $prenom, $nom, $adress, $CP, $ville, $date_emb, $id);
    $result = $stmt1->execute();

    $mdp = bcrypt($mdp, PASSWORD_BCRYPT);

    $sql2 = "UPDATE user SET 
             U_login = ?, 
             U_password = ? 
             WHERE VIS_ID = ?";

    $stmt2 = $visiteurBD->prepare($sql2);
    $stmt2->bind_param("sss", $login, $mdp, $id);
    $result2 = $stmt2->execute();

    if ($result && $result2) {
        echo "Enregistrement mis à jour avec succès.<br/>";
        header('Location: liste_visit.php');
        exit(); // Ensure script stops execution after redirect
    } else {
        echo "Erreur lors de la mise à jour de l'enregistrement : " . $visiteurBD->error . "<br/>";
    }
}
