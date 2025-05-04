<?php
session_start();
include_once '../back_end/db_conn.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    echo "<p>Devi essere loggato per prenotare un appuntamento. <a href='../login/login.php'>Accedi qui</a></p>";
    exit();
}

// Otteniamo l'id dell'utente
$username = $_SESSION['username'];
$query = $conn->prepare("SELECT id FROM utente WHERE username = ?");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
while ($row = $result->fetch_assoc()) {
    $user_id = $row['id'];
}

// Verifica parametri necessari
if (!isset($_GET['id_barbiere']) || !isset($_GET['data'])) {
    die("Parametri mancanti");
}

$barbiere_id = intval($_GET['id_barbiere']);
$data = $conn->real_escape_string($_GET['data']);

// Verifica se è stata inviata una richiesta di prenotazione
if (isset($_POST['prenota']) && isset($_POST['orario'])) {
    $orario = $conn->real_escape_string($_POST['orario']);
    $data_ora = $data . ' ' . $orario;

    // Inserisci la prenotazione nel database
    $insert_query = $conn->prepare("
        INSERT INTO taglio (id_barbiere, id_cliente, data_ora) 
        VALUES (?, ?, ?)
    ");
    $insert_query->bind_param("iis", $barbiere_id, $user_id, $data_ora);

    if ($insert_query->execute()) {
        echo "<div style='padding: 10px; background: #c8e6c9; border-radius: 5px; margin-bottom: 15px;'>
            <p>Prenotazione confermata per il giorno " . htmlspecialchars($data) . " alle ore " . htmlspecialchars($orario) . "</p>
        </div>";
    } else {
        echo "<div style='padding: 10px; background: #ffcdd2; border-radius: 5px; margin-bottom: 15px;'>
            <p>Errore nella prenotazione: " . $conn->error . "</p>
        </div>";
    }
    $insert_query->close();
}

// 1. Ottieni tutti gli orari già prenotati per quella data
$query = $conn->prepare("
    SELECT TIME(data_ora) AS orario 
    FROM taglio 
    WHERE id_barbiere = ? 
    AND DATE(data_ora) = ?
");
$query->bind_param("is", $barbiere_id, $data);
$query->execute();
$result = $query->get_result();

$orari_prenotati = [];
while ($row = $result->fetch_assoc()) {
    $orari_prenotati[] = $row['orario'];
}

// 2. Genera tutti gli orari possibili (8:00-18:00, ogni 30 min)
$orari_disponibili = [];
$inizio = strtotime("08:00");
$fine = strtotime("18:00");

while ($inizio <= $fine) {
    $orario_corrente = date("H:i:s", $inizio);

    // 3. Controlla se l'orario è libero
    if (!in_array($orario_corrente, $orari_prenotati)) {
        $orari_disponibili[] = date("H:i", $inizio);
    }

    $inizio = strtotime('+30 minutes', $inizio);
}

// 4. Mostra gli orari disponibili
if (!empty($orari_disponibili)) {
    echo "<h3>Orari disponibili per il " . htmlspecialchars($data) . "</h3>";
    echo "<div style='display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;'>";

    foreach ($orari_disponibili as $orario) {
        echo "<div style='padding: 10px; background: #e0f7fa; border-radius: 5px; cursor: pointer; text-align: center;'>";
        echo "<form method='post' action='?id_barbiere=$barbiere_id&data=$data' style='margin: 0;'>";
        echo "<input type='hidden' name='orario' value='" . htmlspecialchars($orario) . ":00'>";
        echo "<button type='submit' name='prenota' style='background: none; border: none; width: 100%; cursor: pointer; font-size: 16px;'>";
        echo htmlspecialchars($orario);
        echo "</button>";
        echo "</form>";
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<p>Nessun orario disponibile per il " . htmlspecialchars($data) . ".</p>";
}

$query->close();
$conn->close();
