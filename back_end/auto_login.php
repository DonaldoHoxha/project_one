<?php
function autoLogin($conn)
{
    if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_me'])) {
        list($selector, $token) = explode(':', $_COOKIE['remember_me']);

        if ($selector !== false && $token !== false) {
            $query = $conn->prepare("SELECT auth_tokens.*, utente.username 
                                    FROM auth_tokens 
                                    JOIN utente ON auth_tokens.user_id = utente.id 
                                    WHERE selector = ? AND expires >= ?");
            $now = time();
            $query->bind_param("si", $selector, $now);
            $query->execute();
            $result = $query->get_result();

            if ($row = $result->fetch_assoc()) {
                if (password_verify($token, $row['token'])) {
                    // Login successful via remember me cookie
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];

                    // Optionally renew the token
                    $new_token = bin2hex(random_bytes(32));
                    $hashed_new_token = password_hash($new_token, PASSWORD_DEFAULT);
                    $expires = time() + 86400 * 30;

                    $update_query = $conn->prepare("UPDATE auth_tokens SET token = ?, expires = ? WHERE selector = ?");
                    $update_query->bind_param("sis", $hashed_new_token, $expires, $selector);
                    $update_query->execute();

                    // Update cookie
                    $cookie_value = $selector . ':' . $new_token;
                    $cookie_options = [
                        'expires'  => $expires,
                        'path'     => '/',
                        'secure'   => true,
                        'httponly' => true,
                        'samesite' => 'Strict'
                    ];
                    setcookie("remember_me", $cookie_value, $cookie_options);

                    return true;
                }
            }

            // Token is invalid or expired, clear the cookie
            setcookie('remember_me', '', time() - 3600, '/', '', true, true);
        }
    }

    return false;
}
