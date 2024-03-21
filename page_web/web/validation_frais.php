<?php
include 'db_connect.php'; // Inclure le fichier de connexion à la base de données

$cnxBDD = connexion(); // Établir la connexion à la base de données

// Requête SQL pour récupérer la quantité de frais de repas au forfait
$query_repas = "SELECT LIG_QTE FROM ligne_frais_forfait WHERE FOR_ID = 'REP'";
$result_repas = $cnxBDD->query($query_repas) or die("Requête invalide : " . $query_repas);

// Récupérer la valeur des frais de repas au forfait
$row_repas = $result_repas->fetch_assoc();
$ligne_frais_repas = $row_repas['LIG_QTE'];

// Requête SQL pour récupérer la quantité de frais de nuitée au forfait
$query_nuitee = "SELECT LIG_QTE FROM ligne_frais_forfait WHERE FOR_ID = 'NUI'";
$result_nuitee = $cnxBDD->query($query_nuitee) or die("Requête invalide : " . $query_nuitee);

// Récupérer la valeur des frais de nuitée au forfait
$row_nuitee = $result_nuitee->fetch_assoc();
$ligne_frais_nuitee = $row_nuitee['LIG_QTE'];

// Requête SQL pour récupérer la quantité de frais d'étape au forfait
$query_etape = "SELECT LIG_QTE FROM ligne_frais_forfait WHERE FOR_ID = 'ETP'";
$result_etape = $cnxBDD->query($query_etape) or die("Requête invalide : " . $query_etape);

// Récupérer la valeur des frais d'étape au forfait
$row_etape = $result_etape->fetch_assoc();
$ligne_frais_etape = $row_etape['LIG_QTE'];
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
                            echo '<option value="' . htmlspecialchars($row['VIS_NOM']) . '">' . htmlspecialchars($row['VIS_NOM']) . '</option>';
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
                    <th><label for="etape">Etapee</label></th>
                    <th><label for="kilometre">Km</label></th>
                    <th>Situation</th>
                </tr>
                <tr>
                     <td><input type="text" name="TxTrepas" id="repas" value="<?php echo $ligne_frais_rep; ?>"
                            disabled="disabled"></td>
                    <td><input type="text" name="TxTnuit" id="nuit" value="<?php echo $ligne_frais_nuitee; ?>"></td>

                    <td><input type="text" name="TxTetape" id="etape" value="<?php echo $ligne_frais_etape; ?>"></td>
                    <td><input type="text" name="TxTkilometre" id="kilometre" value="<?php echo $ligne_frais_km; ?>">
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
