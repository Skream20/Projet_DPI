<?php

include 'fonction/db_connect.php'; 

$conn = connexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $visiteurId = $_POST['visiteur_id'];
    $mois = $_POST['mois'];
    $annee = $_POST['annee'];
    $repas = $_POST['repas'];
    $nuit = $_POST['nuit'];
    $etape = $_POST['etape'];
    $km = $_POST['km'];

    // Vérification des données
    if (empty($visiteurId) || empty($mois) || empty($annee)) {
        echo "Veuillez remplir tous les champs obligatoires.";
    } else {
        // Générer un nouvel ID pour la fiche frais
        $query = "SELECT MAX(FFR_ID) AS max_id FROM fiche_frais";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $newFicheId = $row['max_id'] + 1;

        // Insérer la fiche frais
        $insertFiche = "INSERT INTO fiche_frais (FFR_ID, VIS_ID, ETA_ID, FFR_ANNEE, FFR_MOIS, FFR_MONTANT_VALIDE, FFR_NB_JUSTIFICATIF, FFR_DATE_MODIF) 
                        VALUES ('$newFicheId', '$visiteurId', '$visiteurId', '$annee', '$mois', 0, 0, NOW())";
        if ($conn->query($insertFiche) === true) {
            // Insérer les lignes de frais forfait
            $insertLignes = "INSERT INTO ligne_frais_forfait (FFR_ID, FOR_ID, LIG_QTE) VALUES
                            ('$newFicheId', 'REP', '$repas'),
                            ('$newFicheId', 'NUI', '$nuit'),
                            ('$newFicheId', 'ETP', '$etape'),
                            ('$newFicheId', 'KM', '$km')";
            if ($conn->query($insertLignes) === true) {
                echo "Fiche frais créée avec succès.";
            } else {
                echo "Erreur lors de l'insertion des lignes de frais forfait : " . $conn->error;
            }
        } else {
            echo "Erreur lors de la création de la fiche frais : " . $conn->error;
        }
    }
}

// Récupérer les visiteurs depuis la base de données
$visiteurs = [];
$queryVisiteurs = "SELECT VIS_ID, VIS_NOM FROM visiteur";
$resultVisiteurs = $conn->query($queryVisiteurs);
if ($resultVisiteurs->num_rows > 0) {
    while ($row = $resultVisiteurs->fetch_assoc()) {
        $visiteurs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Fiche Frais</title>
    <link rel="stylesheet" href="css/liste_visit.css"> 
</head>
<body>
    <h1>Créer une Fiche Frais</h1>
    <form method="POST" action="">
        <label for="visiteur_id">ID Visiteur:</label>
        <select id="visiteur_id" name="visiteur_id" required>
            <option value="">-- Sélectionnez un visiteur --</option>
            <?php foreach ($visiteurs as $visiteur): ?>
                <option value="<?= htmlspecialchars($visiteur['VIS_ID']) ?>">
                    <?= htmlspecialchars($visiteur['VIS_NOM']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="mois">Mois:</label>
        <select id="mois" name="mois" required>
            <option value="JANVIER">Janvier</option>
            <option value="FEVRIER">Février</option>
            <option value="MARS">Mars</option>
            <option value="AVRIL">Avril</option>
            <option value="MAI">Mai</option>
            <option value="JUIN">Juin</option>
            <option value="JUILLET">Juillet</option>
            <option value="AOUT">Août</option>
            <option value="SEPTEMBRE">Septembre</option>
            <option value="OCTOBRE">Octobre</option>
            <option value="NOVEMBRE">Novembre</option>
            <option value="DECEMBRE">Décembre</option>
        </select><br><br>

        <label for="annee">Année:</label>
        <input type="text" id="annee" name="annee" required><br><br>

        <h2>Frais au Forfait</h2>
        <label for="repas">Repas:</label>
        <input type="number" id="repas" name="repas" required><br><br>

        <label for="nuit">Nuitées:</label>
        <input type="number" id="nuit" name="nuit" required><br><br>

        <label for="etape">Étape:</label>
        <input type="number" id="etape" name="etape" required><br><br>

        <label for="km">Kilomètres:</label>
        <input type="number" id="km" name="km" required><br><br>

        <button type="submit">Créer la Fiche Frais</button>
    </form>
</body>
</html>
