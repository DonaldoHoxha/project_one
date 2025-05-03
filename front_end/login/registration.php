<?php
session_start();
include_once("../back_end/db_conn.php");

// Gestione degli errori
$error = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'username_exists':
            $error = "Username già esistente";
            break;
        case 'password_mismatch':
            $error = "Le password non coincidono";
            break;
        case 'missing_fields':
            $error = "Compila tutti i campi";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="../stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container sign-up-container">
            <form action="../back_end/process_registration.php" method="POST">
                <h1>Crea Account</h1>
                <?php if ($error): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>o usa la tua email per registrarti</span>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirmed_password" placeholder="Conferma Password" required />
                </div>
                <button type="submit">Registrati</button>
                <p class="mobile-text">Hai già un account? <a href="login.php">Accedi</a></p>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Bentornato!</h1>
                    <p>Se hai già un account, accedi per continuare il tuo viaggio con noi</p>
                    <button class="ghost" id="signIn" onclick="window.location.href='login.php'">Accedi</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>