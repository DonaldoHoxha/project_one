<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeautyStyle - Prenotazioni</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">BeautyStyle</div>
            <button class="theme-toggle" id="themeToggle">🌓</button>
        </header>
        <div class="welcome-message">
            <h1>Benvenuto su BeautyStyle</h1>
            <p>La tua app per prenotare il tuo prossimo taglio di capelli</p>
        </div>
        <a href="#" class="cta-button">PRENOTA ORA</a>
        <div class="recent-appointments">
            <h2>I tuoi prossimi appuntamenti</h2>
            <div class="appointment-card">
                <p class="appointment-date">10 Maggio 2025, 14:30</p>
                <p class="appointment-service">Taglio di capelli e piega</p>
                <p class="appointment-stylist">con Paolo Rossi</p>
            </div>
        </div>
        <div class="services-section">
            <h2>Servizi Popolari</h2>
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

    <nav class="navbar">
        <a href="#" class="nav-item active">
            <div class="nav-icon">🏠</div>
            <span>Home</span>
        </a>
        <a href="#" class="nav-item">
            <div class="nav-icon">📅</div>
            <span>Appuntamenti</span>
        </a>
        <a href="#" class="nav-item">
            <div class="nav-icon">ℹ️</div>
            <span>Informazioni</span>
        </a>
        <a href="#" class="nav-item">
            <div class="nav-icon">⚙️</div>
            <span>Impostazioni</span>
        </a>
    </nav>

</body>

</html>