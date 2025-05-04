<?php
?>
<!DOCTYPE html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<html lang="it">
<link rel="stylesheet" href="style.css">
<div class="footer-navbar" name="barra-navigazione">
    <div class="footer-nav-container">
        <a href="index.php" class="footer-nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">
            <div class="footer-nav-icon">
                <i class="fas fa-home"></i>
            </div>
            <span>Home</span>
        </a>
        <?php
        if (isset($_SESSION['username'])) {
            echo '<a href="appuntamenti.php" class="footer-nav-item ' . ((basename($_SERVER['PHP_SELF']) == 'appuntamenti.php') ? 'active' : '') . '">
            <div class="footer-nav-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <span>Appuntamenti</span>
        </a>';
        } else {
            echo '<a href="login/login.php" class="footer-nav-item ' . ((basename($_SERVER['PHP_SELF']) == 'appuntamenti.php') ? 'active' : '') . '">
            <div class="footer-nav-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <span>Appuntamenti</span>
        </a>';
        }
        ?>
        <a href="informazioni.php" class="footer-nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'informazioni.php') ? 'active' : ''; ?>">
            <div class="footer-nav-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <span>Informazioni</span>
        </a>
        <a href="impostazioni.php" class="footer-nav-item <?php echo (basename($_SERVER['PHP_SELF']) == 'impostazioni.php') ? 'active' : ''; ?>">
            <div class="footer-nav-icon">
                <i class="fas fa-cog"></i>
            </div>
            <span>Impostazioni</span>
        </a>
    </div>
</div>
<!-- Includi Font Awesome per le icone -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">