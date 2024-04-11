<?php
include 'db_connect.php'; // Include the database connection file

// Fetching data from the database
$query = "SELECT FROM visiteur where VIS_ID = '$id';"; // Select all columns from the 'visiteur' table
$result = $cnxBDD->query($query) or die("Invalid query: " . $query); // Execute the query

// Fetch the result and assign it to variables
$row = $result->fetch_assoc();
$id = $row['VIS_ID'];
$name = $row['VIS_NOM'];
$surname = $row['VIS_PRENOM'];
$adr = $row['VIS_ADRESSE'];
$city = $row['VIS_VILLE'];
$CP = $row['VIS_CP'];
$embauche = $row['VIS_DATE_EMBAUCHE'];
$login = $_GET["TxTlogin"];
$mdp = $_GET["TxTmdp"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="index.css" />
  <title>Formulaire Visiteur</title>
</head>
<body>
  <div id="titre">
    <h1>VISITEUR</h1>
    <br />
  </div>
  <div id="questionnaire">
    <form method="get" action="formulaire_visiteur.php">
      <p>
        <code>
          <label for="identifiant">Identifiant: </label>
          <input type="text" name="TxTID" id="ID" value="<?php echo $id;?>" />
          <br />

          <label for="Nom">Nom: </label>
          <input type="text" name="TxTNom" id="nom" value="<?php echo $name;?>" />
          <br />

          <label for="prenom">Prenom: </label>
          <input type="text" name="TxTprenom" id="prenom" value="<?php echo $surname;?>" />
          <br />

          <label for="adresse">Adresse: </label>
          <input type="text" name="TxTadresse" id="adresse" value="<?php echo $adr;?>" />
          <br />

          <label for="ville">Ville: </label>
          <input type="text" name="TxTville" id="ville" value="<?php echo $city;?>" />
          <br />

          <label for="cp">CP: </label>
          <input type="text" name="TxTcp" id="cp" value="<?php echo $CP;?>" />
          <br />

          <label for="embauche">Date embauche: </label>
          <input type="text" name="TxTembauche" id="embauche" value="<?php echo $embauche;?>" />
          <br />

          <label for="login">Login: </label>
          <input type="text" name="TxTlogin" id="login" value="<?php echo $login;?>" />
          <br />

          <label for="mdp">Mdp: </label>
          <input type="password" name="TxTmdp" id="mdp" value="<?php echo $mdp;?>" />
          <br />

          <input type="submit" value="Envoyer le formulaire" name="submit" />
        </code>
      </p>
    </form>
  </div>
</body>
</html>