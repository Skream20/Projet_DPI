<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Gestion_frais.css"/>
</head>
<body>
    <div id="hautpage">
        <h1>Gestion des Frais</h1>
        <img id="image" src="img/gsb.png">
    </div>
    <br>
    
    <div id="pageprinc">
        <h2>Saisie</h2>
        <br>
        <p>
            
            <form method="get" action="fonction/remplir_id.php">
                <label for="engagement">PÉRIODE D'ENGAGEMENT:</label> 
                <label id="moisform" for="mois">Mois (2 chiffres):</label>
                <input size="7" type="text" name="TxTMois" id="mois" value="<?php echo date('m'); ?>">
                <label id="anneeform" for="annee">Année (4 chiffres):</label>
                <input size="7" type="text" name="TxTAnnee" id="annee" value="<?php echo date('Y'); ?>">
                <br><br>


                <h2>Frais au forfait</h2>

                <label for="repas">Repas Midi:</label>
                <input size="5" type="text" name="TxTRepas" id="repas">
                <br><br>

                <label for="nuit">Nuitées:</label>
                <input size="5" type="text" name="TxTNuit" id="nuit">
                <br><br>

                <label for="etape">Etape:</label>
                <input size="5" type="text" name="TxTEtape" id="etape">
                <br><br>

                <label for="km">Km:</label>
                <input size="5" type="text" name="TxTKm" id="km">
                <br><br>

                <input id="pied" type="submit" value="Soumettre la requête">
            </form>
            <br><br>
        </p>
    </div>
</body>
</html>

