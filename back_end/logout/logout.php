<?php
session_start();
include_once("../db_conn.php");

// Clear session
session_unset();
session_destroy();

// Clear remember me token if exists
if (isset($_COOKIE['remember_me'])) {
    // Delete from database
    list($selector, $token) = explode(':', $_COOKIE['remember_me']);

    if ($selector !== false && $token !== false) {
        $delete_query = $conn->prepare("DELETE FROM auth_tokens WHERE selector = ?");
        $delete_query->bind_param("s", $selector);
        $delete_query->execute();
    }

    // Expire the cookie
    setcookie('remember_me', '', time() - 3600, '/', '', true, true);
}

// Clear all cookies
foreach ($_COOKIE as $key => $value) {
    setcookie($key, '', time() - 3600, '/');
    unset($_COOKIE[$key]);
}

header("Location: ../../front_end/index.php");
