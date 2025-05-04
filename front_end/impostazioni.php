<?php
session_start();
include_once("../back_end/db_conn.php");
include_once("../back_end/auto_login.php");

// Try auto login if session is not set
if (!isset($_SESSION['user_id'])) {
    autoLogin($conn);
}

// Titolo della pagina
$pageTitle = "Impostazioni";

// Inizializza variabili per i valori salvati (in un'applicazione reale, questi verrebbero caricati da un database)
$notificheEmail = true;
$notifichePush = true;
$temaScuro = false;
$lingua = "it";

// Gestione del form quando viene inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Salva le preferenze (in un'applicazione reale, qui salveresti nel database)
    $notificheEmail = isset($_POST['notifiche_email']) ? true : false;
    $notifichePush = isset($_POST['notifiche_push']) ? true : false;
    $temaScuro = isset($_POST['tema_scuro']) ? true : false;
    $lingua = $_POST['lingua'];

    // Messaggio di conferma
    $messaggioSalvataggio = "Le impostazioni sono state salvate con successo!";
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="impostazioni.css">
</head>

<body class="<?php echo $temaScuro ? 'dark-mode' : ''; ?>">
    <div class="container">
        <header class="settings-header">
            <h1><i class="fas fa-cog"></i> <?php echo $pageTitle; ?></h1>
        </header>

        <?php if (isset($messaggioSalvataggio)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?php echo $messaggioSalvataggio; ?>
            </div>
        <?php endif; ?>

        <div class="settings-panel">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="settings-section">
                    <h2><i class="fas fa-bell"></i> Notifiche</h2>

                    <div class="setting-item">
                        <div class="setting-label">
                            <label for="notifiche_email">Notifiche via Email</label>
                            <p class="setting-description">Ricevi aggiornamenti importanti via email</p>
                        </div>
                        <div class="setting-control">
                            <label class="toggle">
                                <input type="checkbox" id="notifiche_email" name="notifiche_email" <?php echo $notificheEmail ? 'checked' : ''; ?>>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <div class="setting-item">
                        <div class="setting-label">
                            <label for="notifiche_push">Notifiche Push</label>
                            <p class="setting-description">Ricevi notifiche in tempo reale sul tuo dispositivo</p>
                        </div>
                        <div class="setting-control">
                            <label class="toggle">
                                <input type="checkbox" id="notifiche_push" name="notifiche_push" <?php echo $notifichePush ? 'checked' : ''; ?>>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="settings-section">
                    <h2><i class="fas fa-palette"></i> Aspetto</h2>

                    <div class="setting-item">
                        <div class="setting-label">
                            <label for="tema_scuro">Tema Scuro</label>
                            <p class="setting-description">Attiva la modalità scura per ridurre l'affaticamento degli occhi</p>
                        </div>
                        <div class="setting-control">
                            <label class="toggle">
                                <input type="checkbox" id="tema_scuro" name="tema_scuro" <?php echo $temaScuro ? 'checked' : ''; ?>>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="settings-section">
                    <h2><i class="fas fa-language"></i> Lingua</h2>

                    <div class="setting-item">
                        <div class="setting-label">
                            <label for="lingua">Seleziona Lingua</label>
                            <p class="setting-description">Scegli la lingua dell'interfaccia</p>
                        </div>
                        <div class="setting-control">
                            <select id="lingua" name="lingua" class="select-input">
                                <option value="it" <?php echo $lingua == 'it' ? 'selected' : ''; ?>>Italiano</option>
                                <option value="en" <?php echo $lingua == 'en' ? 'selected' : ''; ?>>English</option>
                                <option value="fr" <?php echo $lingua == 'fr' ? 'selected' : ''; ?>>Français</option>
                                <option value="de" <?php echo $lingua == 'de' ? 'selected' : ''; ?>>Deutsch</option>
                                <option value="es" <?php echo $lingua == 'es' ? 'selected' : ''; ?>>Español</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="settings-section">
                    <h2><i class="fas fa-user-shield"></i> Privacy</h2>

                    <div class="setting-item">
                        <div class="setting-info">
                            <p>Per gestire le tue informazioni personali e controllare come vengono utilizzati i tuoi dati, visita il <a href="#">Centro Privacy</a>.</p>
                        </div>
                    </div>
                </div>

                <div class="settings-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Salva Impostazioni
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-undo"></i> Ripristina
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'barra-navigazione.php'; ?>

    <script>
        // Script per il tema scuro (toggle in tempo reale)
        document.getElementById('tema_scuro').addEventListener('change', function() {
            document.body.classList.toggle('dark-mode', this.checked);
        });
    </script>
</body>

</html>