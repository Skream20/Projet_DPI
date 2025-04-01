<?php
session_start(); // Démarre une session PHP pour gérer les données utilisateur
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/connexion.css">
    <style>
    </style>
</head>
<body>
    <div class="login-container">
        <?php if (!isset($_SESSION['role'])): // Vérifie si l'utilisateur n'est pas connecté ?>
           
            <h1>Login</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">User</label>
                    <input type="text" id="username" name="username" required> <!-- Champ pour le nom d'utilisateur -->
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required> <!-- Champ pour le mot de passe -->
                </div>
                <div class="form-group">
                    <button type="submit">Login</button> <!-- Bouton pour soumettre le formulaire -->
                </div>
            </form>
        <?php else: // Si l'utilisateur est connecté ?>
            <p style="color: green;"><?= htmlspecialchars($_SESSION['role']) ?></p> <!-- Affiche le rôle de l'utilisateur -->
            <form action="fonction/logout.php" method="POST">
            <button type="submit">Logout</button> <!-- Bouton pour se déconnecter -->
            </form>
        <?php endif; ?>

        <?php
        // Vérifie si le formulaire a été soumis et que l'utilisateur n'est pas connecté
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['role'])) {
            $username = $_POST['username']; // Récupère le nom d'utilisateur
            $password = $_POST['password']; // Récupère le mot de passe

            include 'fonction/db_connect.php'; // Inclut le fichier de connexion à la base de données
            $mysqli = connexion(); // Établit une connexion à la base de données

            if ($mysqli instanceof mysqli) { // Vérifie si la connexion à la base de données est réussie
                // Prépare une requête SQL pour vérifier les informations de connexion
                $stmt = $mysqli->prepare('SELECT role FROM user WHERE U_login = ? AND U_password = ?');
                $stmt->bind_param('ss', $username, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) { // Si un utilisateur correspondant est trouvé
                    $row = $result->fetch_assoc();
                    $_SESSION['role'] = $row['role']; // Stocke le rôle de l'utilisateur dans la session
                    echo '<script>location.reload();</script>'; // Recharge la page pour mettre à jour l'affichage
                } else {
                    echo '<p style="color: red;">Invalid username or password.</p>'; // Message d'erreur si les informations sont incorrectes
                }

                $stmt->close(); // Ferme la requête préparée
                $mysqli->close(); // Ferme la connexion à la base de données
            } else {
                echo '<p style="color: red;">Database connection failed.</p>'; // Message d'erreur si la connexion échoue
            }
        }
        ?>
    </div>

    <!-- Section des outils -->
    <?php if (isset($_SESSION['role'])): // Affiche les outils si l'utilisateur est connecté ?>
        <h1>Tools</h1>
    <?php endif; ?>

    <ul>
        <!-- Liens vers différentes pages en fonction des rôles -->
        <li class="admin-link"><a href="liste_visit.php">Liste des Visiteurs</a></li>
        <li class="admin-link gestionnaire-link"><a href="visiteur.html">Formulaire inscription des Visiteurs</a></li>
        <li class="admin-link comptable-link"><a href="Gestion_frais.php">Gestion des Frais</a></li>
    </ul>
    
    <script>
    // Script pour afficher les liens en fonction du rôle de l'utilisateur
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($_SESSION['role'])): ?>
            const role = <?= json_encode($_SESSION['role']); ?>; // Récupère le rôle de l'utilisateur
            if (role === 'admin') {
                document.querySelectorAll('.admin-link').forEach(link => link.style.display = 'block'); // Affiche les liens pour les administrateurs
            }
            if (role === 'comptable') {
                document.querySelectorAll('.comptable-link').forEach(link => link.style.display = 'block'); // Affiche les liens pour les comptables
            }
            if (role === 'gestionnaire') {
                document.querySelectorAll('.gestionnaire-link').forEach(link => link.style.display = 'block'); // Affiche les liens pour les gestionnaires
            }
        <?php endif; ?>
    });
    </script>
    
</body>
</html>
