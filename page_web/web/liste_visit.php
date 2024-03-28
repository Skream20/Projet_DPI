<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Votre en-tête ici -->
</head>
<body>
    <p>Liste Visiteur</p>
    <p>Ajouter</p>

    <table>
        <tr class="entete">
            <td>Nom</td>
            <td>Prénom</td>
            <td>Date d'embauche</td>
            <td>Supprimer</td>
            <td>Modifier</td>
        </tr>

        <?php
        include 'db_connect.php'; // Assurez-vous que le chemin vers db_connect.php est correct

        $cnxBDD = connexion();

        $sql = "SELECT * FROM visiteur ORDER BY VIS_NOM, VIS_PRENOM;";
        $result = $cnxBDD->query($sql) or die("Requête invalide : " . $sql);

        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td> <?php echo htmlspecialchars($row['VIS_NOM']); ?></td>
                <td> <?php echo htmlspecialchars($row['VIS_PRENOM']); ?></td>
                <td> <?php echo htmlspecialchars($row['VIS_DATE_EMBAUCHE']); ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
</body>
</html>
        