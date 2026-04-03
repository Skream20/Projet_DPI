<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

include 'fonction/db_connect.php'; // Inclure le fichier de connexion à la base de données

$cnxBDD = connexion(); // Établir la connexion à la base de données

// Prepared statement for flat rate fees
$forfeits = ['REP', 'KM', 'NUI', 'ETP'];
$fees = [];

foreach ($forfeits as $forfeit) {
    $stmt = $cnxBDD->prepare("SELECT LIG_QTE FROM ligne_frais_forfait WHERE FOR_ID = ?");
    $stmt->bind_param("s", $forfeit);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $fees[$forfeit] = $row['LIG_QTE'] ?? 0;
}

$ligne_frais_rep = $fees['REP'];
$ligne_frais_km = $fees['KM'];
$ligne_frais_nuitee = $fees['NUI'];
$ligne_frais_etape = $fees['ETP'];

// Prepared statement for visitors
$stmt = $cnxBDD->prepare("SELECT VIS_ID, VIS_NOM FROM visiteur");
$stmt->execute();
$result = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Validation des frais visiteur</title>
    <link rel="stylesheet" href="traitement_frais.css" />
</head>

<body>
    <h1>Validation des frais par visiteur</h1>
    <br>
    <div>
        <form method="get" action="">
            <p>
                <label for="visiteur">Choisir le visiteur:</label>
                <select name="Txtvisiteur" id="visiteur">
                    <optgroup label="Visiteur">
                        <?php
                        // Parcourir les résultats et générer les options du menu déroulant
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['VIS_ID']) . '">' . htmlspecialchars($row['VIS_NOM']) . '</option>';
                        }
                        ?>
                    </optgroup>
                </select>


                <br>

                <label for="mois1">Mois: </label>
                <select name="TxTmois1" id="mois1">
                    <option value=""></option>
                    <option value="janvier">Janvier</option>
                    <option value="fevrier">Février</option>
                    <option value="mars">Mars</option>
                    <option value="avril">Avril</option>
                    <option value="mai">Mai</option>
                    <option value="juin">Juin</option>
                    <option value="juillet">Juillet</option>
                    <option value="aout">Aout</option>
                    <option value="septembre">Septembre</option>
                    <option value="octobre">Octobre</option>
                    <option value="novembre">Novembre</option>
                    <option value="decembre">Decembre</option>
                </select>
                <select name="TxTmois2" id="mois2">
                    <option value=""></option>
                    <option value="janvier">Janvier</option>
                    <option value="fevrier">Février</option>
                    <option value="mars">Mars</option>
                    <option value="avril">Avril</option>
                    <option value="mai">Mai</option>
                    <option value="juin">Juin</option>
                    <option value="juillet">Juillet</option>
                    <option value="aout">Aout</option>
                    <option value="septembre">Septembre</option>
                    <option value="octobre">Octobre</option>
                    <option value="novembre">Novembre</option>
                    <option value="decembre">Decembre</option>
                </select>
                <br>
            <h2>Frais au forfait</h2>

            <table border="1">
                <tr>
                    <th><label for="repas">Repas</label></th>
                    <th><label for="nuit">Nuitée</label></th>
                    <th><label for="etape">Etape</label></th>
                    <th><label for="kilometre">Km</label></th>
                    <th>Situation</th>
                </tr>
                <tr>
                    <td><input type="text" name="TxTrepas" id="repas" value="<?php echo $ligne_frais_rep; ?>"
                            disabled="disabled"></td>
                    <td><input type="text" name="TxTnuit" id="nuit" value="<?php echo $ligne_frais_nuitee; ?>"
                            disabled="disabled"></td>

                    <td><input type="text" name="TxTetape" id="etape" value="<?php echo $ligne_frais_etape; ?>"
                            disabled="disabled"></td>
                    <td><input type="text" name="TxTkilometre" id="kilometre" value="<?php echo $ligne_frais_km; ?>"
                            disabled="disabled">
                    </td>
                    <td>

                        <input type="radio" name="Txtsituation" id="valide">
                        <label for="valide">Valide</label>
                        <br>
                        <input type="radio" name="Txtsituation" id="nonvalide">
                        <label for="nonvalide">Non Valide</label>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <br>

            <label for="justificatifs">Nb Justificatifs</label>
            <input type="text" name="justificatifs" id="justificatifs">
            <input id="pied" type="submit" value="Soumettre la requête" />

            </p>
        </form>
    </div>
</body>

</html>