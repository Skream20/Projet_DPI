<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Affiche Frais</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <h1>Liste des Fiches de Frais</h1>
  <?php
  include_once 'fonction/db_connect.php';

  $conn = connexion();

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $delete_sql = "DELETE FROM fiche_frais WHERE FFR_ID = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
  }

  $sql = "SELECT fiche_frais.FFR_ID, fiche_frais.FFR_MOIS, fiche_frais.FFR_ANNEE,
    SUM(ligne_frais_forfait.LIG_QTE * frais_forfait.FOR_MONTANT) AS total,
    etat.ETA_LIB
    FROM fiche_frais
    LEFT JOIN ligne_frais_forfait ON fiche_frais.FFR_ID = ligne_frais_forfait.FFR_ID
    LEFT JOIN frais_forfait ON ligne_frais_forfait.FOR_ID = frais_forfait.FOR_ID
    LEFT JOIN etat ON fiche_frais.ETA_ID = etat.ETA_ID
    GROUP BY fiche_frais.FFR_ID, fiche_frais.FFR_MOIS, fiche_frais.FFR_ANNEE, etat.ETA_LIB";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo "<form method='POST'>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Mois</th><th>Année</th><th>Total</th><th>Situation</th><th>Action</th></tr>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . htmlspecialchars($row["FFR_ID"] ?? '') . "</td>";
      echo "<td>" . htmlspecialchars($row["FFR_MOIS"] ?? '') . "</td>";
      echo "<td>" . htmlspecialchars($row["FFR_ANNEE"] ?? '') . "</td>";
      echo "<td>" . (isset($row["total"]) ? number_format((float)$row["total"], 2) . " €" : "0.00 €") . "</td>";
      echo "<td>" . htmlspecialchars($row["ETA_LIB"] ?? '') . "</td>";
      echo "<td><button type='submit' name='delete_id' value='" . htmlspecialchars($row["FFR_ID"] ?? '') . "'>Supprimer</button></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "</form>";
  } else {
    echo "<p>Aucune fiche de frais trouvée.</p>";
  }

  $conn->close();
  ?>
  ?>
</body>
</html>
