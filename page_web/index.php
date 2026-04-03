<?php

// HSTS (HTTP Strict Transport Security) - Force le navigateur à n'utiliser QUE HTTPS pour ce domaine pendant 1 an
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");

// Configuration sécurisée des cookies de session AVANT session_start()
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => isset($_SERVER['HTTPS']), // true si HTTPS
    'httponly' => true, // Empêche l'accès au cookie via JavaScript (contre XSS)
    'samesite' => 'Strict' // Empêche l'envoi du cookie lors de requêtes cross-site (contre CSRF)
]);

session_start(); // Démarre une session PHP pour gérer les données utilisateur

// Protection contre le vol de session (Session Hijacking) en vérifiant l'IP et le User-Agent
if (isset($_SESSION['role'])) {
    if ($_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
        // En cas de mismatch, on détruit la session (vol potentiel)
        session_unset();
        session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// === GESTION DU POST (À FAIRE AVANT L'AFFICHAGE HTML POUR QUE LE CAPTCHA RESTE SYNCHRONISÉ) ===
$erreur_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['role'])) {
    
    // Protection anti brute-force
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }
    
    if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
        $erreur_message = '<p style="color: red;">Authentication failed. Please try again later.</p>';
    } else {
        // Supprimer le verrouillage si le temps est écoulé
        if (isset($_SESSION['lockout_time'])) {
            unset($_SESSION['lockout_time']);
            $_SESSION['login_attempts'] = 0;
        }

        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $dino_score = $_POST['dino_score'] ?? '0';

        // --- Vérification CAPTCHA Touhou ---
        $is_bot = ($dino_score !== '1000');

        if ($is_bot) {
            // Échec du jeu de type Touhou / pénalisé
            $_SESSION['login_attempts']++;
            if ($_SESSION['login_attempts'] >= 5) {
                $_SESSION['lockout_time'] = time() + 30; // Bloqué 30s
                $erreur_message = '<p style="color: red;">Authentication failed. Please try again later.</p>';
            } else {
                usleep(500000);
                $erreur_message = '<p style="color: red;">Authentication failed (Bot detected).</p>';
            }
        } else {
            // Si le jeu/captcha est réussi, on vérifie les caractères spéciaux interdits
            $forbidden_chars = ['|', ',', ')', '/', ';'];
            $username_has_forbidden = false;
            $password_has_forbidden = false;

            foreach ($forbidden_chars as $char) {
                if (strpos($username, $char) !== false) $username_has_forbidden = true;
                if (strpos($password, $char) !== false) $password_has_forbidden = true;
            }

            if ($username_has_forbidden || $password_has_forbidden) {
                $erreur_message = '<p style="color: red;">Authentication failed.</p>';
            } else {
                include_once 'fonction/db_connect.php';
                $mysqli = connexion(); 

                if ($mysqli instanceof mysqli) {
                    $stmt = $mysqli->prepare('SELECT role, U_password FROM user WHERE U_login = ?');
                    $stmt->bind_param('s', $username);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $login_success = false;

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        
                        // Verification mdp
                        if (password_verify($password, $row['U_password']) || $password === $row['U_password']) {
                            $login_success = true;
                            $_SESSION['login_attempts'] = 0;
                            unset($_SESSION['lockout_time']);
                            
                            $_SESSION['role'] = htmlspecialchars($row['role'], ENT_QUOTES, 'UTF-8');
                            $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                            
                            header("Location: index.php");
                            exit();
                        }
                    }
                    
                    if (!$login_success) {
                        $_SESSION['login_attempts']++;
                        if ($_SESSION['login_attempts'] >= 5) {
                            $_SESSION['lockout_time'] = time() + 30;
                            $erreur_message = '<p style="color: red;">Authentication failed. Please try again later.</p>';
                        } else {
                            usleep(500000);
                            $erreur_message = '<p style="color: red;">Authentication failed.</p>';
                        }
                    }
                    $stmt->close();
                    $mysqli->close();
                } else {
                    $erreur_message = '<p style="color: red;">Authentication failed.</p>';
                }
            }
        }
    }
}

// (On pourrait regénérer un token de jeu ici)
if (!isset($_SESSION['role'])) {
    $_SESSION['dino_token'] = bin2hex(random_bytes(16));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/connexion.css">
    <style>
        #dino-container {
            width: 100%;
            max-width: 400px;
            height: 300px;
            border: 2px solid #555;
            margin: 10px auto;
            position: relative;
            background: #000000;
            border-radius: 5px;
            overflow: hidden;
            cursor: crosshair;
        }
        #dinoGame {
            width: 100%;
            height: 100%;
            display: block;
        }
        #loginSubmitBtn {
            opacity: 0.3;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php if (!isset($_SESSION['role'])): // Vérifie si l'utilisateur n'est pas connecté ?>

            <h1>Login</h1>
            <form action="" method="POST">
                <?php
                // Génère et stocke un token CSRF en session
                if (empty($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }
                ?>
                <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                <div class="form-group">
                    <label for="username">User</label>
                    <input type="text" id="username" name="username" required autocomplete="username" maxlength="20">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password" maxlength="20">
                </div> <!-- Fermeture du div manquante -->

                <div style="text-align:center; margin-top:20px;">
                    <p style="font-weight:bold; margin-bottom:5px;">[ CAPTCHA TOUHOU ] Survivez au Bullet Hell (Score 1000) grâce à la souris</p>
                    <div id="dino-container">
                        <canvas id="dinoGame" width="400" height="300"></canvas>

                <div class="form-group">
                    <button type="submit" id="loginSubmitBtn" disabled>Login (Atteignez 1000 points)</button>
                </div>
            </form>
            <?= $erreur_message; // Affiche l'erreur sous le formulaire si le login échoue ?>
        <?php else: // Si l'utilisateur est connecté ?>
            <p style="color: green;"><?= htmlspecialchars($_SESSION['role']) ?></p> <!-- Affiche le rôle de l'utilisateur -->
            <form action="fonction/logout.php" method="POST">
            <button type="submit">Logout</button> <!-- Bouton pour se déconnecter -->
            </form>
        <?php endif; ?>
    </div>

    <!-- Section des outils -->
    <?php if (isset($_SESSION['role'])): // Affiche les outils si l'utilisateur est connecté ?>
        <h1>Tools</h1>

        <ul>
            <!-- Liens vers différentes pages en fonction des rôles -->
            <li class="admin-link"><a href="liste_visit.php">Liste des Visiteurs</a></li>
            <li class="admin-link gestionnaire-link"><a href="Visiteur.php">Formulaire inscription des Visiteurs</a></li>
            <li class="admin-link comptable-link"><a href="Gestion_frais.php">Gestion des Frais</a></li>
            <li class="admin-link gestionnaire-link"><a href="Cfiche_frais.php">Créer une Fiche de Frais</a></li>
            <li class="admin-link gestionnaire-link"><a href="Afiche_frais.php">Afficher les Fiches de Frais</a></li>
        </ul>
    <?php endif; ?>
    
    <script>
    // Script pour afficher les liens en fonction du rôle de l'utilisateur
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($_SESSION['role'])): ?>
            const role = <?= json_encode($_SESSION['role']); ?>; // Récupère le rôle de l'utilisateur
            if (role === 'admin') {
                document.querySelectorAll('.admin-link').forEach(function(link) {
                    link.style.display = 'block'; // Montre les liens pour les administrateurs
                });
            }
            if (role === 'comptable') {
                document.querySelectorAll('.comptable-link').forEach(function(link){
                    link.style.display = 'block'; // Affiche les liens pour les comptables
                }); 
            }
            if (role === 'gestionnaire') {
                document.querySelectorAll('.gestionnaire-link').forEach(function(link){
                    link.style.display = 'block'; // Affiche les liens pour les gestionnaires
                }); 
            }
        <?php endif; ?>
    });
    </script>
    
    <?php if (!isset($_SESSION['role'])): ?>
    <script>
    // --- INTEGRATION JEU TOUHOU (BULLET HELL) ---
    (function() {
        const canvas = document.getElementById('dinoGame');
        const ctx = canvas.getContext('2d');
        let score = 0;
        let gameInterval;
        let gameOver = false;
        let gameWon = false;

        // Joueur
        let player = { x: 200, y: 250, radius: 5, hitHitbox: 2 };

        // Projectiles
        let bullets = [];
        let frameCount = 0;

        // Mouvement Souris
        canvas.addEventListener('mousemove', function(e) {
            if (gameOver || gameWon) return;
            const rect = canvas.getBoundingClientRect();
            player.x = e.clientX - rect.left;
            player.y = e.clientY - rect.top;
            if(player.x < player.radius) player.x = player.radius;
            if(player.x > canvas.width - player.radius) player.x = canvas.width - player.radius;
            if(player.y < player.radius) player.y = player.radius;
            if(player.y > canvas.height - player.radius) player.y = canvas.height - player.radius;
        });

        function spawnBullets() {
            if (frameCount % 60 === 0) {
                let numBullets = 12;
                let angleStep = (Math.PI * 2) / numBullets;
                for (let i = 0; i < numBullets; i++) {
                    bullets.push({
                        x: 200, y: 50,
                        vx: Math.cos(angleStep * i) * 2,
                        vy: Math.sin(angleStep * i) * 2,
                        radius: 4, color: 'magenta'
                    });
                }
            }
            if (frameCount % 5 === 0) {
                let angle = frameCount * 0.1;
                bullets.push({
                    x: 200, y: 50,
                    vx: Math.cos(angle) * 3,
                    vy: Math.sin(angle) * 3,
                    radius: 3, color: 'yellow'
                });
            }
            if (frameCount % 45 === 0) {
                let angleToPlayer = Math.atan2(player.y - 20, player.x - 50);
                bullets.push({
                    x: 50, y: 20,
                    vx: Math.cos(angleToPlayer) * 3,
                    vy: Math.sin(angleToPlayer) * 3,
                    radius: 5, color: 'cyan'
                });
                let angleToPlayer2 = Math.atan2(player.y - 20, player.x - 350);
                bullets.push({
                    x: 350, y: 20,
                    vx: Math.cos(angleToPlayer2) * 3,
                    vy: Math.sin(angleToPlayer2) * 3,
                    radius: 5, color: 'cyan'
                });
            }
        }

        function draw() {
            if (gameOver || gameWon) return;
            frameCount++;

            // Clear screen
            ctx.fillStyle = '#000000';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Spawner Boss
            ctx.fillStyle = 'red';
            ctx.beginPath();
            ctx.arc(200, 50, 15, 0, Math.PI * 2);
            ctx.fill();

            spawnBullets();

            // Update & Draw Bullets
            for (let i = bullets.length - 1; i >= 0; i--) {
                let b = bullets[i];
                b.x += b.vx;
                b.y += b.vy;
                
                ctx.fillStyle = b.color;
                ctx.beginPath();
                ctx.arc(b.x, b.y, b.radius, 0, Math.PI * 2);
                ctx.fill();

                if (b.x < -10 || b.x > canvas.width + 10 || b.y < -10 || b.y > canvas.height + 10) {
                    bullets.splice(i, 1);
                    continue;
                }

                let dx = player.x - b.x;
                let dy = player.y - b.y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < player.hitHitbox + b.radius) {
                    score = 0;
                    bullets = [];
                    ctx.fillStyle = 'red';
                    ctx.font = '20px sans-serif';
                    ctx.fillText('Aïe! Score Réinitialisé', 100, canvas.height / 2);
                    return;
                }
            }

            score++;

            ctx.fillStyle = 'white';
            ctx.beginPath();
            ctx.arc(player.x, player.y, player.radius + 3, 0, Math.PI * 2);
            ctx.fill();
            ctx.fillStyle = 'red';
            ctx.beginPath();
            ctx.arc(player.x, player.y, player.hitHitbox, 0, Math.PI * 2);
            ctx.fill();

            ctx.fillStyle = 'white';
            ctx.font = '16px monospace';
            ctx.fillText('Score: ' + score + ' / 1000', 10, 25);

            if (score >= 1000) {
                gameWon = true;
                clearInterval(gameInterval);
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                
                ctx.fillStyle = 'green';
                ctx.font = '20px bold sans-serif';
                ctx.fillText('SURVIE CONFIRMÉE', 110, canvas.height / 2 - 15);
                ctx.fillText('VOUS N\\'ÊTES PAS UN ROBOT', 60, canvas.height / 2 + 15);
                
                document.getElementById('dino_score_input').value = '1000';
                const submitBtn = document.getElementById('loginSubmitBtn');
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1.0';
                submitBtn.style.cursor = 'pointer';
                submitBtn.innerText = 'Login';
            }
        }

        gameInterval = setInterval(draw, 20);
    })();
    </script>
    <?php endif; ?>

</body>
</html>




