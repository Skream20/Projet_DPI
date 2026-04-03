<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Visiteurs</title>
</head>
<body>
    <p>Liste Visiteur</p>
    <a href="Visiteur.php" > Ajouter </a>

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
        
        $sql = "SELECT * FROM visiteur ORDER BY VIS_NOM, VIS_PRENOM";
        $stmt = $cnxBDD->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td> <?php echo htmlspecialchars($row['VIS_NOM']); ?></td>
                <td> <?php echo htmlspecialchars($row['VIS_PRENOM']); ?></td>
                <td> <?php echo htmlspecialchars($row['VIS_DATE_EMBAUCHE']); ?></td>
                <td>
                    <form action="fonction/supprimer_visiteur.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['VIS_ID']); ?>">
                        <button type="submit" name="supprimer"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </td>
                <td>
                    <form action="visiteur_edit.php" method="post">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['VIS_ID']); ?>">
                        <button type="submit" name="modifier"><i class="fa-solid fa-edit"></i></button>
                    </form>
                </td>
            </tr>
        <?php
        }
        $stmt->close();
        $cnxBDD->close();
        ?>

    </table>
</body>
</html>
