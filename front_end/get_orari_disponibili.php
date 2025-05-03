<?php
session_start();
include_once '../back_end/db_conn.php';

if (!isset($_GET['id_barbiere']) || !isset($_GET['data'])) {
    die("Parametri mancanti");
}

$barbiere_id = intval($_GET['id_barbiere']);
$data = $conn->real_escape_string($_GET['data']);

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
        echo "<div style='padding: 10px; background: #e0f7fa; border-radius: 5px;'>";
        echo htmlspecialchars($orario);
        echo "</div>";
    }

    echo "</div>";
} else {
    echo "<p>Nessun orario disponibile per il " . htmlspecialchars($data) . ".</p>";
}

$query->close();
$conn->close();
