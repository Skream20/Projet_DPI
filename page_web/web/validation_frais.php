<?php
include 'db_connect.php';
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>validation frais visiteur</title>
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

                        $cnxBDD = connexion(); // Établir la connexion à la base de données

                        // Requête SQL pour récupérer les noms des visiteurs
                        $query = "SELECT * FROM visiteur ORDER BY VIS_NOM, VIS_PRENOM;"; // Requête pour récupérer les noms des visiteurs

                        // Exécution de la requête
                        $result = $cnxBDD->query($query) or die("Requete invalide : " . $query);

                        // Parcourir les résultats et générer les options du menu déroulant
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($row['VIS_NOM']) . '">' . htmlspecialchars($row['VIS_NOM']) . '</option>';
                        }
                        ?>
                    </optgroup>
                </select>


                <br>

                <label for="mois">Mois: </label>
                <select name="TxTmois" id="mois">
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
                <select name="TxTmois" id="mois">
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
                    <td><input type="text" name="TxTrepas" id="repas" value="$ligne_frais_km" disabled="disabled">
                        <?php


                        $cnxBDD = connexion(); // Établir la connexion à la base de données

                        // Requête SQL pour récupérer la quantité de frais au forfait
                        $query = "SELECT LIG_QTE FROM ligne_frais_forfait WHERE FOR_ID = 'km'";

                        // Exécution de la requête
                        $result = $cnxBDD->query($query) or die("Requête invalide : " . $query);

                        // Récupérer la valeur de la quantité de frais au forfait
                        $row = $result->fetch_assoc();
                        $ligne_frais_km = $row['LIG_QTE'];
                        ?>
                    </td>
                    <td><input type="text" name="TxTnuit" id="nuit"></td>

                    <td><input type="text" name="TxTetape" id="etape"></td>
                    <td><input type="text" name="TxTkilometre" id="kilometre"></td>
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