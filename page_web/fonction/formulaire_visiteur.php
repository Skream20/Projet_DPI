<?php
include 'db_connect.php';

// Connexion à la base de données BDEtudiant
$visiteurBD = connexion();

#enregistre user
function visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp)
{
    // Vérification si VIS_ID existe déjà
    $checkSql = "SELECT VIS_ID FROM visiteur WHERE VIS_ID = ?";
    $checkStmt = $visiteurBD->prepare($checkSql);
    $checkStmt->bind_param("s", $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        echo "Erreur : L'ID du visiteur existe déjà.<br/>";
        $checkStmt->close();
        return;
    }
    $checkStmt->close();

    $sql = "INSERT INTO visiteur(VIS_ID, VIS_PRENOM, VIS_NOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $sql2 = "INSERT INTO `user`(VIS_ID, U_login, U_password, dteconnexion) VALUES (?, ?, ?, CURRENT_TIMESTAMP())";

    $stmtVisiteur = $visiteurBD->prepare($sql);
    $stmtUser = $visiteurBD->prepare($sql2);

    if (!$stmtVisiteur || !$stmtUser) {
        echo "Erreur lors de la préparation des requêtes : " . $visiteurBD->error . "<br/>";
        return;
    }

    $stmtVisiteur->bind_param("sssssss", $id, $prenom, $nom, $adress, $CP, $ville, $date_emb);
    $stmtUser->bind_param("sss", $id, $login, $mdp);

    $result = $stmtVisiteur->execute();
    $result2 = $stmtUser->execute();

    $stmtVisiteur->close();
    $stmtUser->close();

    if ($result && $result2) {
        header('Location: ../liste_visit.php');
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'enregistrement : " . $visiteurBD->error . "<br/>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = trim($_POST['TxTID'] ?? '');
    $nom = trim($_POST['TxTNom'] ?? '');
    $prenom = trim($_POST['TxTprenom'] ?? '');
    $adress = trim($_POST['TxTadresse'] ?? '');
    $ville = trim($_POST['TxTville'] ?? '');
    $CP = trim($_POST['TxTcp'] ?? '');
    $date_emb = trim($_POST['TxTembauche'] ?? '');
    $login = trim($_POST['TxTlogin'] ?? '');
    $mdp = $_POST['TxTmdp'] ?? '';

    if ($id === '' || $nom === '' || $prenom === '' || $adress === '' || $ville === '' || $CP === '' || $date_emb === '' || $login === '' || $mdp === '') {
        echo "Erreur : tous les champs sont obligatoires.<br/>";
    } else {
        $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        visiteur($visiteurBD, $id, $nom, $prenom, $adress, $ville, $CP, $date_emb, $login, $mdp);
    }
}

// Fermer la connexion MYSQL à la fin du script
$visiteurBD->close();

?>

