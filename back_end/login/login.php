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
            $_SESSION['username'] = $username;
            header("Location: ../../front_end/index.php");
        } else {
            header("Location: ../../front_end/login/login.html?password errata");
        }
    } else {
        header("Location: ../../front_end/login/login.html?username errato");
    }
} else {
    header("Location: ../../front_end/login/login.html?campi mancanti");
}
