<?php
session_start();
include_once("../back_end/db_conn.php");
include_once("../back_end/auto_login.php");

// Try auto login if session is not set
if (!isset($_SESSION['user_id'])) {
    autoLogin($conn);
}

include 'barra-navigazione.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appuntamenti</title>
</head>

<body>
    <?php
    include_once "../back_end/db_conn.php";
    // Otteniamo l'id dell'utente
    $username = $_SESSION['username'];
    $query = $conn->prepare("SELECT id FROM utente WHERE username = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        $user_id = $row['id'];
    }
    // Otteniamo tutti gli appuntamenti dell'utente
    $query = $conn->prepare("SELECT * FROM taglio WHERE id_utente = ?");
    $query->bind_param("s", $user_id);
    $query->execute();
    $result = $query->get_result();
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . $row['data_ora'] . "</p>";
        echo "<p>" . $row['price'] . "</p>";
    }

    ?>
</body>

</html>