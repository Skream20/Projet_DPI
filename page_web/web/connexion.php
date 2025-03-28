<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Styles for the login page */
        .login-container {
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 10px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 5px;
            font-size: 16px;
        }
        .form-group button {
            padding: 5px 10px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .admin-link, .comptable-link, .gestionnaire-link {
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <?php if (!isset($_SESSION['role'])): ?>
           
            <h1>Login</h1>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">User</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Login</button>
                </div>
            </form>
        <?php else: ?>
            <p style="color: green;"><?= htmlspecialchars($_SESSION['role']) ?></p>
            <form action="logout.php" method="POST">
            <button type="submit">Logout</button>
            </form>
        <?php endif; ?>

        <?php
     
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_SESSION['role'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            include 'db_connect.php';
            $mysqli = connexion();

            if ($mysqli instanceof mysqli) {
                $stmt = $mysqli->prepare('SELECT role FROM user WHERE U_login = ? AND U_password = ?');
                $stmt->bind_param('ss', $username, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION['role'] = $row['role'];
                    echo '<script>location.reload();</script>';
                } else {
                    echo '<p style="color: red;">Invalid username or password.</p>';
                }

                $stmt->close();
                $mysqli->close();
            } else {
                echo '<p style="color: red;">Database connection failed.</p>';
            }
        }
        ?>
    </div>

    <!-- Tools Section -->
    <h1>Tools</h1>
    <ul>
        <li class="admin-link"><a href="liste_visit.php">Liste des Visiteurs</a></li>
        <li class="admin-link gestionnaire-link"><a href="visiteur.html">Formulaire inscription des Visiteurs</a></li>
        <li class="admin-link comptable-link"><a href="Gestion_frais.php">Gestion des Frais</a></li>
    </ul>
    
    <script>
    // Display tools section based on the user's role
    document.addEventListener('DOMContentLoaded', function () {
        <?php if (isset($_SESSION['role'])): ?>
            const role = <?= json_encode($_SESSION['role']); ?>;
            if (role === 'admin') {
                document.querySelectorAll('.admin-link').forEach(link => link.style.display = 'block');
            }
            if (role === 'comptable') {
                document.querySelectorAll('.comptable-link').forEach(link => link.style.display = 'block');
            }
            if (role === 'gestionnaire') {
                document.querySelectorAll('.gestionnaire-link').forEach(link => link.style.display = 'block');
            }
        <?php endif; ?>
    });
</script>
    
</body>
</html>

