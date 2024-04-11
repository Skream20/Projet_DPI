<?php
include '../functions.php';
$mysqli = connexion();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha256-lhwFyS6rL4ZP+buFuvN3A6qJT8ogc1f3WhQS/CtYR4g=" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/263fbfd00d.js" crossorigin="anonymous"></script>
    <title>GSB - Fiche de frais</title>

    <link rel="stylesheet" href="fichedefrais.css">
</head>

<body>
    <!-- Contenu de votre page -->
    <h1>Validation des frais par visiteur</h1>
    <form method="POST" action="test4.php">
        <select name="nom" required>
            <option disabled selected hidden></option>

            <?php
            $query = $mysqli->prepare("SELECT VIS_ID, VIS_PRENOM, VIS_NOM FROM visiteur");
            $query->execute();
            $result = $query->get_result();

            while ($row = $result->fetch_assoc()) {
            ?>
                <option value="<?= $row['VIS_ID'] ?>"><?= $row['VIS_PRENOM'] . " " . $row['VIS_NOM'] . " "  . $row['VIS_ID']?></option>
            <?php }

            $query->close();
            $mysqli->close();
            ?>

        </select>
        <p>Mois :
            <select name="mois" required>
                <option disabled selected hidden></option>

                <?php
                $moisListe = array('JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN', 'JUILLET', 'AOUT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DECEMBRE');

                foreach ($moisListe as $mois) {
                ?>
                    <option value="<?php echo $mois; ?>"><?php echo $mois; ?></option>
                <?php }

                ?>

            </select>
            <select name="annee" required>
                <option disabled selected hidden></option>

                <?php
                $anneeListe = array('2023', '2024');

                foreach ($anneeListe as $annee) {
                    echo '<option value="' . $annee . '">' . $annee . '</option>';
                }
                ?>
            </select>
        </p>
        <button type="submit" name="Envoyer" value="Envoyer">
            Envoyer <i class="fas fa-check" style="color: #15b244;"></i>
        </button>


    </form>

    <form method="POST" action="test3.php">
        <h1>Frais au forfait</h1>
        <table>
            <thead>
                <tr>
                    <th>Repas midi</th>
                    <th>Nuitée</th>
                    <th>Etape</th>
                    <th>Km</th>
                    <th>Situation</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="repas_midi" placeholder="5" disabled></td>
                    <td><input type="text" name="nuitee" placeholder="2" disabled></td>
                    <td><input type="text" name="etape" placeholder="8" disabled></td>
                    <td><input type="text" name="km" placeholder="55" disabled></td>
                    <td>
                        <input type="radio" id="test1" name="drone" value="test1" checked />
                        <label for="test1">Accepter</label>
                        <input type="radio" id="test2" name="drone" value="test2" />
                        <label for="test2">Refuser</label>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <br />

        <table>
            <thead>
                <tr>
                    <th class="fiche-confirmation">Nb Justificatifs</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="justifications" name="justifications" placeholder="Exemple : 29"></td></td>
                </tr>
            </tbody>
        </table>

        <br /><input type="submit" class="confirmation-fiche" name="button-confirme" value="Envoyer le formulaire">
    </form>
</body>

</html>