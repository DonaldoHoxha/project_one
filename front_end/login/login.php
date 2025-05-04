<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-container sign-in-container">
            <form action="../../back_end/login/login.php" method="POST">
                <h1>Accedi</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>o usa il tuo account</span>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="username" required />
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>
                <a href="#" class="forgot">Password dimenticata?</a>
                <button type="submit">Accedi</button>
                <p class="mobile-text">Non hai un account? <a href="registration.php">Registrati</a></p>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Ciao!</h1>
                    <p>Registrati e inizia il tuo viaggio con noi</p>
                    <button class="ghost" id="signUp"
                        onclick="window.location.href='registration.php'">Registrati</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>