<?php
session_start();
include_once("../db_conn.php");

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmed_password']) && isset($_POST['email'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirmed_password = trim($_POST['confirmed_password']);
    $email = trim($_POST['email']);

    // Validazione
    if (empty($username) || empty($password) || empty($confirmed_password) || empty($email)) {
        header("Location: ../../front_end/login/registration.php?error=missing_fields");
        exit();
    }

    if ($password !== $confirmed_password) {
        header("Location: ../../front_end/login/registration.php?error=password_mismatch");
        exit();
    }

    // Controlla se l'utente esiste già
    $query = $conn->prepare("SELECT id FROM utente WHERE username = ? OR email = ?");
    $query->bind_param("ss", $username, $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../../front_end/login/registration.php?error=username_exists");
        exit();
    }

    // Crea l'utente
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $query = $conn->prepare("INSERT INTO utente (username, password, email) VALUES (?, ?, ?)");
    $query->bind_param("sss", $username, $hashed_password, $email);

    if ($query->execute()) {
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['username'] = $username;

        // Handle "Remember Me" checkbox for registration
        if (isset($_POST['remember'])) {
            $user_id = $conn->insert_id;

            // Create a secure token
            $selector = bin2hex(random_bytes(8));
            $token = bin2hex(random_bytes(32));
            $hashed_token = password_hash($token, PASSWORD_DEFAULT);

            // Set expiration date - 30 days
            $expires = time() + 86400 * 30;

            // Store token in database
            $insert_query = $conn->prepare("INSERT INTO auth_tokens (user_id, selector, token, expires) VALUES (?, ?, ?, ?)");
            $insert_query->bind_param("issi", $user_id, $selector, $hashed_token, $expires);
            $insert_query->execute();

            // Set secure cookie
            $cookie_value = $selector . ':' . $token;
            $cookie_options = [
                'expires'  => $expires,
                'path'     => '/',
                'secure'   => true,    // Requires HTTPS
                'httponly' => true,
                'samesite' => 'Strict'
            ];
            setcookie("remember_me", $cookie_value, $cookie_options);
        }

        header("Location: ../../front_end/index.php");
        exit();
    } else {
        header("Location: ../../front_end/login/registration.php?error=database_error");
        exit();
    }
} else {
    header("Location: ../../front_end/login/registration.php?error=missing_fields");
    exit();
}
