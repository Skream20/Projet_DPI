<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>formulaire</title>
</head>

<body>
  <h1>Formulaire de Remboursement</h1>
  <h3>Veuillez remplire les information ci-dessous</h3>
  <form action="traitement.php" method="get">
    <div>
      <label for="kilo">Kilomètre parcourus/> <br />
        <br /> : </label>
      <input type="number" id="kilo" name="TXTkilo" <label for="rep">Repas Consommer : </label>
      <input type="number" id="rep" name="TXTrep" /> <br />
      <br />

      <label for="hot">nuit d'hotel : </label>
      <input type="number" id="hot" name="TXThot" /> <br />
      <br />
    </div>
    <div>
      <input type="submit" id="valider" name="BOvalider" value="Envoyer le formulaire" />

    </div>
  </form>
</body>

</html>