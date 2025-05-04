<?php
session_start();
include_once '../back_end/db_conn.php';

// Verifica se l'ID barbiere è valido
$barbiere_id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
if ($barbiere_id <= 0) {
    die("ID barbiere non valido o mancante. L'URL dovrebbe essere: personale.php?id=1");
}

// Imposta la data minima a oggi
$oggi = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prenotazioni Barbiere</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Prenotazioni per Barbiere <?php echo htmlspecialchars($barbiere_id); ?></h1>

    <form id="dateForm">
        <label for="data">Seleziona data:</label>
        <input type="date" id="data" name="data" min="<?php echo $oggi; ?>" value="<?php echo $oggi; ?>" required>
        <input type="hidden" name="id_barbiere" value="<?php echo $barbiere_id; ?>">
        <button type="button" onclick="caricaOrariDisponibili()">Cerca</button>
    </form>

    <div id="orari-disponibili">
        <!-- Qui appariranno i risultati -->
    </div>

    <script>
        // Imposta la data minima a oggi anche con JavaScript per browser più vecchi
        const oggi = new Date().toISOString().split('T')[0];
        document.getElementById('data').setAttribute('min', oggi);

        function caricaOrariDisponibili() {
            const data = document.getElementById('data').value;
            const idBarbiere = <?php echo $barbiere_id; ?>;

            fetch(`../back_end/get_orari_disponibili.php?id_barbiere=${idBarbiere}&data=${data}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('orari-disponibili').innerHTML = html;
                })
                .catch(error => {
                    console.error('Errore:', error);
                    document.getElementById('orari-disponibili').innerHTML =
                        '<p>Errore nel caricamento degli orari disponibili</p>';
                });
        }

        // Chiamata iniziale con la data di oggi come default
        window.onload = caricaOrariDisponibili;
        document.getElementById('data').addEventListener('change', caricaOrariDisponibili);
    </script>
</body>

</html>