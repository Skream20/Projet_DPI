<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="index.css" />
  <title>Modification Visiteur</title>
</head>
<body>
    <?php
    include "db_connect.php";
    
    $cnxBDD = connexion();

    $id = isset($_GET['id']) ? $_GET['id'] : null;
    if (!$id) {
    $sql = "SELECT visiteur.*, U_login AS login, U_password AS password
            FROM visiteur
            INNER JOIN user ON visiteur.VIS_ID = user.VIS_ID
            WHERE visiteur.VIS_ID = '$id'";
    $result = $cnxBDD->query($sql) or die("Requête invalide : " . $sql);
    }
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $nom = htmlspecialchars($row['VIS_NOM']);
        $prenom = htmlspecialchars($row['VIS_PRENOM']);
        $adresse = htmlspecialchars($row['VIS_ADRESSE']);
        $ville = htmlspecialchars($row['VIS_VILLE']);
        $cp = htmlspecialchars($row['VIS_CP']);
        $dateEmbauche = date_format(new DateTime($row['VIS_DATE_EMBAUCHE']), 'Y-m-d');
        $login = htmlspecialchars($row['login']);
        $mdp = htmlspecialchars($row['password']);

    }
    ?>

    <div class="Visiteur">
        <form action="modifierEtudiant.php" method="post">
            <h1>MODIFIER VISITEUR</h1>
    </div>
        <div class="formulaire">
            <!-- Utilisez les variables PHP pour pré-remplir les champs -->
            <label for="TabloIdentifiant">Identifiant : </label>
            <input type="text" id="TabloIdentifiant" name="Identifiant" value="<?php echo isset($id) ? $idUtilisateur : ''; ?>" readonly/> <br>
            <label for="TabloNomFamille">Nom : </label> 
            <input type="text" id="TabloNomFamille" name="Nom" value="<?php echo isset($nom) ? $nom : ''; ?>" /> <br>   
            <label for="TabloPrenom">Prenom : </label> 
            <input type="text" id="TabloPrenom" name="Prenom" value="<?php echo isset($prenom) ? $prenom : ''; ?>" /> <br>
            <label for="TabloAdresse">Adresse : </label> 
            <input type="text" id="TabloAdresse" name="Adresse" value="<?php echo isset($adresse) ? $adresse : ''; ?>" /> <br>
            <label for="TabloVille">Ville : </label> 
            <input type="text" id="TabloVille" name="Ville" value="<?php echo isset($ville) ? $ville : ''; ?>" /> <br>
            <label for="TabloCP">CP : </label>
            <input type="text" id="TabloCP" name="CP" value="<?php echo isset($cp) ? $cp : ''; ?>" /> <br>
            <label for="TabloEmbauche">Date embauche : </label> 
            <input type="text" id="TabloEmbauche" name="Embauche" value="<?php echo isset($dateEmbauche) ? $dateEmbauche : ''; ?>" /> <br>
            <label for="TabloLogin">Login : </label> 
            <input type="text" id="TabloLogin" name="Login" value="<?php echo isset($login) ? $login : ''; ?>" /> <br>
            <label for="TabloMDP">mdp : </label> 
            <input type="text" id="TabloMDP" name="MDP" value="<?php echo isset($mdp) ? $mdp : ''; ?>" />
            <input type="submit" id="valider" name="BOvalider" value="VALIDER"/><br>
        </div>
    </form>
</body>
</html>

