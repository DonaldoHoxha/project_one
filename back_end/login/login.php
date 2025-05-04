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
        echo $user['username'];
        if (password_verify($password, $user['password'])) {
            echo $user['username'];
            session_regenerate_id(true);
            if (isset($_POST['remember'])) {
                // Set secure cookie (BEFORE ANY OUTPUT)
                $cookie_options = [
                    'expires'  => time() + 86400 * 30,
                    'path'     => '/',
                    'secure'   => true,    // Requires HTTPS
                    'httponly' => true,
                    'samesite' => 'Strict'
                ];
                setcookie("user", $user['username'], $cookie_options);
            }
            $_SESSION['username'] = $username;
            header("Location: ../../front_end/index.php");
        } else {
            header("Location: ../../front_end/login/login.php?password errata");
        }
    } else {
        header("Location: ../../front_end/login/login.php?username errato");
    }
} else {
    header("Location: ../../front_end/login/login.php?campi mancanti");
}
