<?php
session_start();
include_once("../db_conn.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM utente WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    if (mysqli_num_rows($result) == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];

            // Handle "Remember Me" checkbox
            if (isset($_POST['remember'])) {
                // Create a secure token
                $selector = bin2hex(random_bytes(8));
                $token = bin2hex(random_bytes(32));
                $hashed_token = password_hash($token, PASSWORD_DEFAULT);

                // Set expiration date - 30 days
                $expires = time() + 86400 * 30;

                // Store token in database
                $delete_query = $conn->prepare("DELETE FROM auth_tokens WHERE user_id = ?");
                $delete_query->bind_param("i", $user['id']);
                $delete_query->execute();

                $insert_query = $conn->prepare("INSERT INTO auth_tokens (user_id, selector, token, expires) VALUES (?, ?, ?, ?)");
                $insert_query->bind_param("issi", $user['id'], $selector, $hashed_token, $expires);
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
            header("Location: ../../front_end/login/login.php?error=password_errata");
            exit();
        }
    } else {
        header("Location: ../../front_end/login/login.php?error=username_errato");
        exit();
    }
} else {
    header("Location: ../../front_end/login/login.php?error=campi_mancanti");
    exit();
}
