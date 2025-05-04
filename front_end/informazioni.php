<?php
session_start();
include 'barra-navigazione.php';
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informazioni - Il Nostro Salone</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="info-styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header class="info-header">
        <nav>
            <div class="logo">
                <h1>Il Nostro Salone</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<li><a href='../back_end/logout/logout.php'>Logout</a></li>";
                } else {
                    echo "<li><a href='login/login.php'>Accedi</a></li>";
                    echo "<li><a href='login/registration.php'>Registrati</a></li>";
                }
                ?>
                <li><a href="info.html" class="active">Informazioni</a></li>
            </ul>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <div class="info-container">
        <section class="info-card about-us">
            <div class="card-content">
                <h2><i class="fas fa-info-circle"></i> Chi Siamo</h2>
                <p>Benvenuti al nostro salone di bellezza, dove l'eccellenza incontra il benessere. Da oltre 10 anni, offriamo servizi di alta qualità in un ambiente rilassante e accogliente.</p>
                <p>Il nostro team di professionisti è dedicato a farti sentire al meglio, utilizzando solo prodotti di prima qualità e le tecniche più innovative.</p>
            </div>
        </section>

        <section class="info-card hours">
            <div class="card-content">
                <h2><i class="far fa-clock"></i> Orari di Apertura</h2>
                <ul class="schedule">
                    <li class="day" data-day="1"><span>Lunedì</span><span>8:00 - 18:00</span></li>
                    <li class="day" data-day="2"><span>Martedì</span><span>8:00 - 18:00</span></li>
                    <li class="day" data-day="3"><span>Mercoledì</span><span>8:00 - 18:00</span></li>
                    <li class="day" data-day="4"><span>Giovedì</span><span>8:00 - 18:00</span></li>
                    <li class="day" data-day="5"><span>Venerdì</span><span>8:00 - 18:00</span></li>
                    <li class="day closed" data-day="6"><span>Sabato</span><span>Chiuso</span></li>
                    <li class="day closed" data-day="0"><span>Domenica</span><span>Chiuso</span></li>
                </ul>
            </div>
        </section>

        <section class="info-card contact">
            <div class="card-content">
                <h2><i class="fas fa-phone-alt"></i> Contatti</h2>
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> Via Roma, 123, 00100 Roma, Italia</p>
                    <p><i class="fas fa-phone"></i> +39 06 1234567</p>
                    <p><i class="fas fa-envelope"></i> info@nostrosalone.it</p>
                </div>
            </div>
        </section>

        <section class="info-card location">
            <div class="card-content">
                <h2><i class="fas fa-map-marked-alt"></i> Dove Siamo</h2>
                <div class="map-container">
                    <!-- Google Maps iframe -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d11880.492291371244!2d12.4922309!3d41.8902102!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132f61b6532013ad%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1651774432232!5m2!1sit!2sit"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="directions">
                    <a href="https://www.google.com/maps/dir//Colosseo,+Piazza+del+Colosseo,+Roma,+RM/@41.8902102,12.4922309,15z/" target="_blank" class="directions-btn">
                        <i class="fas fa-directions"></i> Ottieni Indicazioni
                    </a>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2025 Il Nostro Salone - Tutti i diritti riservati</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Evidenzia il giorno corrente
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().getDay(); // 0 è Domenica, 1 è Lunedì, ecc.
            const days = document.querySelectorAll('.day');

            days.forEach(day => {
                if (parseInt(day.dataset.day) === today) {
                    day.classList.add('current-day');
                }
            });

            // Menu hamburger per dispositivi mobili
            const hamburger = document.querySelector('.hamburger');
            const navLinks = document.querySelector('.nav-links');

            if (hamburger) {
                hamburger.addEventListener('click', () => {
                    navLinks.classList.toggle('active');
                    hamburger.classList.toggle('active');
                });
            }

            // Animazioni di entrata per le sezioni
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.info-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
</body>

</html>