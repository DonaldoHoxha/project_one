<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">
<?php include 'barra-navigazione.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmiManera - Prenotazioni</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">A Mi Manera</div>
            <button class="theme-toggle" id="themeToggle">🌓</button>
        </header>
        <div class="welcome-message">
            <h1>Benvenuto
                <?php
                if (isset($_SESSION['username'])) {
                    echo $_SESSION['username'];
                } else {
                    echo "su AmiMansera";
                }
                ?>
            </h1>
            <p>La migliore app per prenotare il tuo prossimo haircut</p>
        </div>
        <?php
        if (isset($_SESSION['username'])) {
            echo "<a href='mostra_personale.php' class='cta-button'>PRENOTA ORA</a>";
        } else {
            echo "<a href='login/login.html' class='cta-button'>PRENOTA ORA</a>";
        }
        ?>

        <div class="recent-appointments">
            <h2>I tuoi prossimi appuntamenti</h2>
            <div class="appointment-card">
                <p class="appointment-date">10 Maggio 2025, 14:30</p>
                <p class="appointment-service">Taglio di capelli e piega</p>
                <p class="appointment-stylist">con X X</p>
            </div>
        </div>
        <?php
        if (isset($_SESSION['username'])) {
            echo "<a href='../back_end/logout/logout.php'><button class='button'>LOGOUT</button></a>";
        } else {
            echo "<a href='login/registration.php'><button class='button'>REGISTRATI</button></a>";
            echo "<a href='login/login.html'><button class='button'>ACCEDI</button></a>";
        }
        ?>
        <div class="services-section">
            <h2>Servizi più richiesti</h2>
            <div class="service-card">
                <h3>Taglio di capelli</h3>
                <p>Taglio professionale per rinnovare il tuo look</p>
                <p class="service-price">€25</p>
            </div>
            <div class="service-card">
                <h3>Taglio e piega</h3>
                <p>Taglio con piega per un look completo</p>
                <p class="service-price">€40</p>
            </div>
            <div class="service-card">
                <h3>Colore e trattamenti</h3>
                <p>Colorazione professionale per capelli</p>
                <p class="service-price">Da €50</p>
            </div>
        </div>

        <div class="promo-section">
            <h2>Promozioni</h2>
            <div class="promo-card">
                <h3>Sconto Studenti</h3>
                <p>20% di sconto su tutti i servizi per studenti</p>
                <p class="promo-expiry">Valido fino al 30 Giugno 2025</p>
            </div>
            <div class="promo-card">
                <h3>Pacchetto Primavera</h3>
                <p>Taglio, piega e trattamento nutriente a soli €60</p>
                <p class="promo-expiry">Valido fino al 31 Maggio 2025</p>
            </div>
        </div>
    </div>


</body>

</html>