<?php
session_start();
include_once("../db_conn.php");

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmed_password']) && isset($_POST['email'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmed_password = $_POST['confirmed_password'];
    $email = $_POST['email'];

    if ($password == $confirmed_password) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = $conn->prepare("SELECT * FROM utente WHERE username = ?");
        $query->bind_param("s", $username);
        $query->execute();
        $result = $query->get_result();
        if (mysqli_num_rows($result) == 0) {
            $query = $conn->prepare("INSERT INTO utente (username, password, email) VALUES (?,?,?)");
            $query->bind_param("sss", $username, $hashed_password, $email);
            $query->execute();
            header("Location: ../../front_end/index.php");
        } else {
            header("Location: ../../front_end/registration/registration.php?username già presente");
        }
    } else {
        header("Location: ../../front_end/registration/registration.php?password non corrispondente");
    }
} else {
    header("Location: ../../front_end/registration/registration.php?inserisci tutti i campi");
}
