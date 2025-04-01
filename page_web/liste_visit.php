<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">

    <title>Liste des Visiteurs</title>
<head>
    <!-- Votre en-tête ici -->
</head>
<body>
    <p>Liste Visiteur</p>
    <a href="Visiteur.html" > Ajouter </a>

    <table>
        <tr>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Date d'embauche</td>
            <td>Supprimer</td>
            <td>Modifier</td>
        </tr>

        <?php
        include 'fonction/db_connect.php'; 

        $cnxBDD = connexion();
        $visiteurBD = $cnxBDD; 

        $sql = "SELECT * FROM visiteur ORDER BY VIS_NOM, VIS_PRENOM;";
        $result = $cnxBDD->query($sql) or die("Requête invalide : " . $sql);

        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td> <?php echo htmlspecialchars($row['VIS_NOM']); ?></td>
                <td> <?php echo htmlspecialchars($row['VIS_PRENOM']); ?></td>
                <td> <?php echo htmlspecialchars($row['VIS_DATE_EMBAUCHE']); ?></td>
                <td>
                    <form action="fonction/supprimer_visiteur.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $row['VIS_ID']; ?>">
                        <button type="submit" name="supprimer"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
                <td>
                    <form action="visiteur_edit.php" method="get">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['VIS_ID']); ?>">
                        <button type="submit" name="modifier"><i class="fa-solid fa-edit"></i></button>
                    </form>
                </td>
            <?php
        }
        $visiteurBD->close();
        ?>

    </table>
</body>
</html>
        